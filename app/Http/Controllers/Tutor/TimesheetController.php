<?php
namespace App\Http\Controllers\Tutor;

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
        $user_id = Session::get('user_id');

        // get schedules
        $db_schedules = DB::table('schedule')
                          ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                          ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                          ->where('schedule_user', $user_id)
                          ->where('schedule_status', '>', 0)
                          ->orderBy('schedule_due_date', 'asc')
                          ->orderBy('schedule_is_marking', 'asc')
                          ->get();

        // return view
        return view('/tutor/timesheet/timesheet', ['db_schedules' => $db_schedules]);
    }

}
