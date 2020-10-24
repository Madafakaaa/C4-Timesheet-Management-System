<?php
namespace App\Http\Controllers\Deputy;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TimesheetController extends Controller
{

    public function timeSheet(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // schedules group by users and courses
        $db_schedules = DB::table('schedule')
                          ->join('user', 'schedule.schedule_user', '=', 'user.user_id')
                          ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                          ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                          ->select(DB::raw('semester_name, user_id, user_first_name, user_last_name, uos_id, uos_name, uos_code, sum(schedule_allocated_duration) as schedule_allocated_duration_sum'))
                          ->where('schedule_status', '=',0)
                          ->groupBy('uos_id')
                          ->groupBy('user_id')
                          ->orderBy('uos_id', 'asc')
                          ->orderBy('user_id', 'asc')
                          ->get();
        $array_schedules = array();
        foreach($db_schedules as $db_schedule){
            $temp = array();
            $temp['semester_name'] = $db_schedule->semester_name;
            $temp['user_id'] = $db_schedule->user_id;
            $temp['user_first_name'] = $db_schedule->user_first_name;
            $temp['user_last_name'] = $db_schedule->user_last_name;
            $temp['uos_id'] = $db_schedule->uos_id;
            $temp['uos_name'] = $db_schedule->uos_name;
            $temp['uos_code'] = $db_schedule->uos_code;
            $temp['schedule_allocated_duration_sum'] = $db_schedule->schedule_allocated_duration_sum;
            // get schedule details
            $temp['schedules'] = array();
            $temp_db_schedules = DB::table('schedule')
                                    ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                                    ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                                    ->select(DB::raw('week_name, sum(schedule_allocated_duration) as schedule_allocated_duration_sum'))
                                    ->where('schedule_status', '=',0)
                                    ->where('schedule_uos', '=',$db_schedule->uos_id)
                                    ->where('schedule_user', '=',$db_schedule->user_id)
                                    ->groupBy('schedule_week')
                                    ->orderBy('schedule_week', 'asc')
                                    ->get();
            foreach($temp_db_schedules as $temp_db_schedule){
                $temp_schedule = array();
                $temp_schedule['week_name'] = $temp_db_schedule->week_name;
                $temp_schedule['schedule_allocated_duration_sum'] = $temp_db_schedule->schedule_allocated_duration_sum;
                $temp['schedules'][] = $temp_schedule;
            }
            $array_schedules[] = $temp;
        }
        // return view
        return view('/deputy/timesheet/timesheet', ['array_schedules' => $array_schedules]);
    }

    public function timeSheetApprove(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the get parameters
        $uos_id = $request->input('uos_id');
        $user_id = $request->input('user_id');
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('schedule')
              ->where('schedule_user', $user_id)
              ->where('schedule_uos', $uos_id)
              ->where('schedule_status', 0)
              ->update(['schedule_status' => 1]);
        }
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return back()->with(['notify' => true,
                                 'type' => 'danger',
                                 'title' => 'Exception!',
                                 'message' => 'Exception!']);
        }
        // Commit transactions
        DB::commit();
        // Redirect to the semester page
        return back()->with(['notify' => true,
                             'type' => 'success',
                             'title' => 'Success!',
                             'message' => 'Success!']);
    }

    public function timeSheetReject(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the get parameters
        $uos_id = $request->input('uos_id');
        $user_id = $request->input('user_id');
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('schedule')
              ->where('schedule_user', $user_id)
              ->where('schedule_uos', $uos_id)
              ->where('schedule_status', 0)
              ->delete();
        }
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return back()->with(['notify' => true,
                                 'type' => 'danger',
                                 'title' => 'Exception!',
                                 'message' => 'Exception!']);
        }
        // Commit transactions
        DB::commit();
        // Redirect to the semester page
        return back()->with(['notify' => true,
                             'type' => 'success',
                             'title' => 'Success!',
                             'message' => 'Success!']);
    }
}
