<?php
namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class HoursController extends Controller
{

    public function hours(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $filters = array(
                        "filter_tutor" => null,
                        "filter_semester" => null,
                   );
        $db_schedules = null;
        $db_user = null;
        $total_allocated_hours = 0;
        $total_claimed_hours = 0;
        $total_claimed_rate = 0;
        // read parameters
        if ($request->filled('filter_tutor')) {
            $filters['filter_tutor']=$request->input("filter_tutor");
            $filters['filter_semester']=$request->input("filter_semester");
            // Get Schedules
            $db_schedules = DB::table('schedule')
                              ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                              ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                              ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                              ->select(DB::raw('uos_code, uos_name, semester_name,
                                                sum(schedule_allocated_duration) as sum_schedule_allocated_duration,
                                                sum(schedule_actual_duration) as sum_schedule_actual_duration'))
                              ->where('schedule_user', $filters['filter_tutor']);
            if($filters['filter_semester']!=0){
                 $db_schedules = $db_schedules->where('semester_id', $filters['filter_semester']);
            }
            $db_schedules = $db_schedules->groupBy('uos_id')->orderBy('semester_id', 'asc')->get();
            $db_user = DB::table('user')->where('user_id', $filters['filter_tutor'])->first();
            foreach($db_schedules as $db_schedule){
                $total_allocated_hours += $db_schedule->sum_schedule_allocated_duration;
                $total_claimed_hours += $db_schedule->sum_schedule_actual_duration;
            }
            if($total_allocated_hours!=0){
                $total_claimed_rate = round(($total_claimed_hours/$total_allocated_hours*100),2);
            }
        }
        // Get tutors
        $db_tutors = DB::table('user')
                       ->where('user_is_casual_academic', 1)
                       ->get();
        // Get semesters
        $db_semesters = DB::table('semester')
                          ->get();
        // return view
        return view('/administrator/hours/hours', ['filters' => $filters,
                                                   'db_tutors' => $db_tutors,
                                                   'db_semesters' => $db_semesters,
                                                   'db_schedules' => $db_schedules,
                                                   'db_user' => $db_user,
                                                   'total_allocated_hours' => $total_allocated_hours,
                                                   'total_claimed_hours' => $total_claimed_hours,
                                                   'total_claimed_rate' => $total_claimed_rate]);
    }

}
