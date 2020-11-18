<?php
namespace App\Http\Controllers\Administrator;

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
        return view('/administrator/timesheet/timesheet', ['db_schedules' => $db_schedules]);
    }

    public function timeSheetApprove(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        // Get the get parameters
        $schedule_id = $request->input('schedule_id');
        $db_schedule = DB::table('schedule')
                          ->join('user', 'schedule.schedule_user', '=', 'user.user_id')
                          ->where('schedule_id', $schedule_id)
                          ->first();
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('schedule')
              ->where('schedule_id', $schedule_id)
              ->update(['schedule_status' => 3]);
            storeNotification($db_schedule->user_id, "approved", "Your schedule [{$db_schedule->schedule_name}] has been approved!");

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


        $schedule_user = DB::table('schedule')
                            ->where('schedule_id',$schedule_id)
                            ->value('schedule_user','schedule_week','schedule_name');

        $schedule_week = DB::table('schedule')
                            ->where('schedule_id',$schedule_id)
                            ->value('schedule_week');

        $schedule_name = DB::table('schedule')
                            ->where('schedule_id',$schedule_id)
                            ->value('schedule_name');


        $notification_type = "Approve";
        $notification_content = $schedule_name . " Week " . $schedule_week;
        $notification_is_read = 0;

        DB::beginTransaction();
        try{
           $notification_id = DB::table('notification')
            ->insertGetId(
                ['notification_user' => $schedule_user,
                 'notification_type' => $notification_type,
                 'notification_content' => $notification_content,
                 'notification_is_read' => $notification_is_read,
                 'notification_create_user' => Session::get('user_id')]
            );}
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
        $db_schedule = DB::table('schedule')
                          ->join('user', 'schedule.schedule_user', '=', 'user.user_id')
                          ->where('schedule_id', $schedule_id)
                          ->first();
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('schedule')
              ->where('schedule_id', $schedule_id)
              ->update(['schedule_status' => 1,
                        'schedule_actual_duration' => 0]);
            storeNotification($db_schedule->user_id, "rejected", "Your schedule [{$db_schedule->schedule_name}] has been rejected!");
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

        $schedule_user = DB::table('schedule')
                            ->where('schedule_id',$schedule_id)
                            ->value('schedule_user','schedule_week','schedule_name');

        $schedule_week = DB::table('schedule')
                            ->where('schedule_id',$schedule_id)
                            ->value('schedule_week');

        $schedule_name = DB::table('schedule')
                            ->where('schedule_id',$schedule_id)
                            ->value('schedule_name');


        $notification_type = "Reject";
        $notification_content = $schedule_name . " Week " . $schedule_week;
        $notification_is_read = 0;

        DB::beginTransaction();
        try{
           $notification_id = DB::table('notification')
            ->insertGetId(
                ['notification_user' => $schedule_user,
                 'notification_type' => $notification_type,
                 'notification_content' => $notification_content,
                 'notification_is_read' => $notification_is_read,
                 'notification_create_user' => Session::get('user_id')]
            );}
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
