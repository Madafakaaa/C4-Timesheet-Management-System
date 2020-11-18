<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Home page
     * URL: GET /home
     */
    public function home(Request $request)
    {
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // ==========================  Administration dashboard  ==========================
        $admin_dashboard = array(
                                  "user_num" => 0,
                                  "admin_num" => 0,
                                  "deputy_num" => 0,
                                  "coordinator_num" => 0,
                                  "tutor_num" => 0,
                                  "semester_num" => 0,
                                  "uos_num" => 0,
                                  "tutorial_num" => 0,
                                  "schedule_num" => 0,
                                );
        $admin_dashboard['user_num'] = DB::table('user')
                                          ->where('user_is_available', 1)
                                          ->count();
        $admin_dashboard['admin_num'] = DB::table('user')
                                          ->where('user_is_administrator', 1)
                                          ->where('user_is_available', 1)
                                          ->count();
        $admin_dashboard['deputy_num'] = DB::table('user')
                                          ->where('user_is_deputy_hos', 1)
                                          ->where('user_is_available', 1)
                                          ->count();
        $admin_dashboard['coordinator_num'] = DB::table('user')
                                          ->where('user_is_casual_academic', 1)
                                          ->where('user_is_available', 1)
                                          ->count();
        $admin_dashboard['tutor_num'] = DB::table('user')
                                          ->where('user_is_uos_coordinator', 1)
                                          ->where('user_is_available', 1)
                                          ->count();
        $admin_dashboard['semester_num'] = DB::table('semester')
                                          ->where('semester_is_available', 1)
                                          ->count();
        $admin_dashboard['uos_num'] = DB::table('uos')
                                          ->where('uos_is_available', 1)
                                          ->count();
        $admin_dashboard['tutorial_num'] = DB::table('tutorial')
                                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                                          ->where('uos_is_available', 1)
                                          ->count();
        $admin_dashboard['schedule_num'] = DB::table('schedule')
                                          ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                                          ->where('uos_is_available', 1)
                                          ->count();
        // ==========================  Coordinator dashboard  ==========================
        $coordinator_dashboard = array(
                                  "uoses" => null,
                                  "uos_num" => 0,
                                  "tutorial_num" => 0,
                                  "tutor_num" => 0,
                                );
        $coordinator_dashboard['uoses'] = DB::table('uos')
                                      ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                                      ->join('uos_coordinator', 'uos_coordinator.uos_coordinator_uos', '=', 'uos.uos_id')
                                      ->where('uos_is_available', 1)
                                      ->where('semester_is_available', 1)
                                      ->where('uos_coordinator_user', Session::get('user_id'))
                                      ->orderBy('uos_id', 'asc')
                                      ->get();
        $coordinator_dashboard['uos_num'] = DB::table('uos')
                                        ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                                        ->join('uos_coordinator', 'uos_coordinator.uos_coordinator_uos', '=', 'uos.uos_id')
                                        ->where('uos_is_available', 1)
                                        ->where('semester_is_available', 1)
                                        ->where('uos_coordinator_user', Session::get('user_id'))
                                        ->count();
        $coordinator_dashboard['tutorial_num'] = DB::table('uos')
                                             ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                                             ->join('uos_coordinator', 'uos_coordinator.uos_coordinator_uos', '=', 'uos.uos_id')
                                             ->join('tutorial', 'uos.uos_id', '=', 'tutorial.tutorial_uos')
                                             ->where('uos_is_available', 1)
                                             ->where('semester_is_available', 1)
                                             ->where('uos_coordinator_user', Session::get('user_id'))
                                             ->count();
        $coordinator_dashboard['tutor_num'] = DB::table('uos')
                                             ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                                             ->join('uos_coordinator', 'uos_coordinator.uos_coordinator_uos', '=', 'uos.uos_id')
                                             ->join('uos_casual_academic', 'uos_casual_academic.uos_casual_academic_uos', '=', 'uos.uos_id')
                                             ->where('uos_is_available', 1)
                                             ->where('semester_is_available', 1)
                                             ->where('uos_coordinator_user', Session::get('user_id'))
                                             ->count();
        // ==========================  Tutor dashboard  ==========================
        $tutor_dashboard = array(
                                  "tutorials" => null,
                                  "schedules" => null,
                                  "uoses" => null,
                                );
        $tutor_dashboard['tutorials'] = DB::table('tutorial_casual_academic')
                                          ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                                          ->where('tutorial_casual_academic_user', Session::get('user_id'))
                                          ->orderBy('tutorial_day_in_week', 'asc')
                                          ->orderBy('tutorial_start_time', 'asc')
                                          ->orderBy('tutorial_id', 'asc')
                                          ->get();
        $tutor_dashboard['schedules'] = DB::table('schedule')
                                          ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                                          ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                                          ->where('schedule_user', Session::get('user_id'))
                                          ->where('schedule_status', '=', 1)
                                          ->orderBy('schedule_due_date', 'asc')
                                          ->orderBy('schedule_is_marking', 'asc')
                                          ->get();
        $uoses = array();
        $db_schedule_uoses = DB::table('schedule')
                               ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                               ->select(DB::raw('uos_id, uos_name, uos_code'))
                               ->where('schedule_user', Session::get('user_id'))
                               ->groupBy('uos_id')
                               ->get();
        foreach($db_schedule_uoses as $db_schedule_uos){
            $temp = array();
            $temp['uos_id'] = $db_schedule_uos->uos_id;
            $temp['uos_code'] = $db_schedule_uos->uos_code;
            $temp['uos_name'] = $db_schedule_uos->uos_name;
            $temp['allocated_hours'] = 0;
            $temp_all_schedules = DB::table('schedule')
                                     ->where('schedule_user', Session::get('user_id'))
                                     ->where('schedule_uos', '=', $db_schedule_uos->uos_id)
                                     ->where('schedule_status', '>', 0)
                                     ->get();
            foreach($temp_all_schedules as $temp_all_schedule){
                $temp['allocated_hours']+=$temp_all_schedule->schedule_allocated_duration;
            }
            $temp['claimed_hours'] = 0;
            $temp_passed_schedules = DB::table('schedule')
                                     ->where('schedule_user', Session::get('user_id'))
                                     ->where('schedule_uos', '=', $db_schedule_uos->uos_id)
                                     ->where('schedule_status', '=', 3)
                                     ->get();
            foreach($temp_passed_schedules as $temp_passed_schedule){
                $temp['claimed_hours']+=$temp_passed_schedule->schedule_actual_duration;
            }
            $temp['claimed_rate'] = round($temp['claimed_hours']/$temp['allocated_hours']*100,2);
            $uoses[] = $temp;
        }
        $tutor_dashboard['uoses'] = $uoses;
        return view('/home', ['admin_dashboard' => $admin_dashboard,'coordinator_dashboard' => $coordinator_dashboard,
                              'tutor_dashboard' => $tutor_dashboard]);
    }

}
