<?php
namespace App\Http\Controllers\Coordinator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TimesheetController extends Controller
{

    public function timesheet(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        // get schedules
        $db_schedules = DB::table('schedule')
                          ->join('user', 'schedule.schedule_user', '=', 'user.user_id')
                          ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                          ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                          ->where('schedule_status', 2)
                          ->orderBy('schedule_due_date', 'asc')
                          ->orderBy('schedule_is_marking', 'asc')
                          ->get();

        // return view
        return view('/coordinator/timesheet/timesheet', ['db_schedules' => $db_schedules]);
    }

    public function timeSheetApprove(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the get parameters
        $schedule_id = $request->input('schedule_id');
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('schedule')
              ->where('schedule_id', $schedule_id)
              ->update(['schedule_status' => 3]);
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
        $schedule_id = $request->input('schedule_id');
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('schedule')
              ->where('schedule_id', $schedule_id)
              ->update(['schedule_status' => 1,
                        'schedule_actual_duration' => 0]);
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
