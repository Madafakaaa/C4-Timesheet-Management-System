<?php
namespace App\Http\Controllers\Tutor;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class UosController extends Controller
{
    /**
     * Read Uos info
     * URL: GET /Uos
     */
    public function Uos(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // get all uos
        $db_uoses = DB::table('uos')
                      ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                      ->join('uos_casual_academic', 'uos_casual_academic.uos_casual_academic_uos', '=', 'uos.uos_id')
                      ->where('uos_is_available', 1)
                      ->where('semester_is_available', 1)
                      ->where('uos_casual_academic_user', Session::get('user_id'))
                      ->orderBy('uos_id', 'asc')
                      ->get();
        // return view
        return view('/tutor/uos/uos', ['db_uoses' => $db_uoses]);
    }

    public function UosPage(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $uos_id = $request->input('id');
        $user_id = Session::get('user_id');
        // get uos info
        $db_uos = DB::table('uos')
                    ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                    ->where('uos_id', $uos_id)
                    ->first();

        // get my tutorials information start
        $db_tutorials = DB::table('tutorial_casual_academic')
                          ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                          ->where('tutorial_uos', $uos_id)
                          ->where('tutorial_casual_academic_user', Session::get('user_id'))
                          ->orderBy('tutorial_day_in_week', 'asc')
                          ->orderBy('tutorial_start_time', 'asc')
                          ->orderBy('tutorial_id', 'asc')
                          ->get();
        $array_tutorials = array();
        foreach($db_tutorials as $db_tutorial){
            $temp = array();
            $temp['tutorial_id'] = $db_tutorial->tutorial_id;
            $temp['tutorial_name'] = $db_tutorial->tutorial_name;
            $temp['tutorial_location'] = $db_tutorial->tutorial_location;
            $temp['tutorial_day_in_week'] = $db_tutorial->tutorial_day_in_week;
            $temp['tutorial_start_time'] = $db_tutorial->tutorial_start_time;
            $temp['tutorial_end_time'] = $db_tutorial->tutorial_end_time;
            // get tutors
            $tutors = DB::table('tutorial_casual_academic')
                        ->join('user', 'tutorial_casual_academic.tutorial_casual_academic_user', '=', 'user.user_id')
                        ->where('tutorial_casual_academic_tutorial', $db_tutorial->tutorial_id)
                        ->get();
            $temp['tutors'] = array();
            $temp['tutor_ids'] = array();
            foreach($tutors as $tutor){
                $temp_tutor = array();
                $temp_tutor['user_id'] = $tutor->user_id;
                $temp_tutor['user_first_name'] = $tutor->user_first_name;
                $temp_tutor['user_last_name'] = $tutor->user_last_name;
                $temp['tutors'][] = $temp_tutor;
                $temp['tutor_ids'][] = $tutor->user_id;
            }
            $array_tutorials[] = $temp;
        }
        // get my tutorials information end


        // get all tutorials information for preference
        $all_tutorials =  DB::table('tutorial')
                            ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                            ->where('tutorial_uos', $uos_id)
                            ->orderBy('tutorial_day_in_week', 'asc')
                            ->orderBy('tutorial_start_time', 'asc')
                            ->orderBy('tutorial_id', 'asc')
                            ->get();
        // get previous preference
        $preferences = array(0,0,0);
        $db_preferences =  DB::table('preference_casual_academic')
                            ->join('tutorial', 'preference_casual_academic.preference_casual_academic_tutorial', '=', 'tutorial.tutorial_id')
                            ->where('tutorial_uos', $uos_id)
                            ->where('preference_casual_academic_user', Session::get('user_id'))
                            ->get();
        foreach($db_preferences as $db_preference){
            $preferences[$db_preference->preference_casual_academic_rank-1] = $db_preference->preference_casual_academic_tutorial;
        }

        // get semester weeks
        $db_weeks = DB::table('week')
                      ->join('semester', 'week.week_semester', '=', 'semester.semester_id')
                      ->join('uos', 'semester.semester_id', '=', 'uos.uos_semester')
                      ->where('uos_id', $uos_id)
                      ->orderBy('week_id', 'asc')
                      ->get();
        // get schedules
        $db_schedules = DB::table('schedule')
                          ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                          ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                          ->where('schedule_uos', $uos_id)
                          ->where('schedule_user', $user_id)
                          ->orderBy('week_id', 'asc')
                          ->orderBy('schedule_is_marking', 'asc')
                          ->get();
        // calculate total approved working hours until now
        $schedule_actual_duration_sum_now = DB::table('schedule')
                                              ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                                              ->where('schedule_uos', $uos_id)
                                              ->where('schedule_user', $user_id)
                                              ->where('schedule_due_date', '<', date('Y-m-d'))
                                              ->where('schedule_status', 3)
                                              ->sum('schedule_actual_duration');
        // calculate total approved allocated hours until now
        $schedule_allocated_duration_sum_now = DB::table('schedule')
                                                 ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                                                 ->where('schedule_uos', $uos_id)
                                                 ->where('schedule_user', $user_id)
                                                 ->where('schedule_due_date', '<', date('Y-m-d'))
                                                 ->where('schedule_status', '>',0)
                                                 ->sum('schedule_allocated_duration');
        // schedules statistics group by weeks
        $db_weekly_schedules = DB::table('schedule')
                                  ->join('week', 'schedule.schedule_week', '=', 'week.week_id')
                                  ->join('uos', 'schedule.schedule_uos', '=', 'uos.uos_id')
                                  ->select(DB::raw('week_name, sum(schedule_allocated_duration) as schedule_allocated_duration_sum,  sum(schedule_actual_duration) as schedule_actual_duration_sum'))
                                  ->where('schedule_uos', $uos_id)
                                  ->where('schedule_user', $user_id)
                                  ->where('schedule_status', '>',0)
                                  ->groupBy('schedule_week')
                                  ->orderBy('schedule_week', 'asc')
                                  ->get();
        // return view
        return view('/tutor/uos/uosPage', ['db_uos' => $db_uos,
                                           'array_tutorials' => $array_tutorials,
                                           'all_tutorials' => $all_tutorials,
                                           'preferences' => $preferences,
                                           'db_weeks' => $db_weeks,
                                           'db_schedules' => $db_schedules,
                                           'schedule_actual_duration_sum_now' => $schedule_actual_duration_sum_now,
                                           'schedule_allocated_duration_sum_now' => $schedule_allocated_duration_sum_now,
                                           'db_weekly_schedules' => $db_weekly_schedules]);
    }

    public function UosPagePreferenceStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $preference_casual_academic_tutorial_1 = $request->input('preference_casual_academic_tutorial_1');
        $preference_casual_academic_tutorial_2 = $request->input('preference_casual_academic_tutorial_2');
        $preference_casual_academic_tutorial_3 = $request->input('preference_casual_academic_tutorial_3');
        $uos_id = $request->input('tutorial_uos');
        // Start transactions
        DB::beginTransaction();
        try{
           // Delete previous preference
           DB::table('preference_casual_academic')
              ->join('tutorial', 'preference_casual_academic.preference_casual_academic_tutorial', '=', 'tutorial.tutorial_id')
              ->where('tutorial_uos', $uos_id)
              ->where('preference_casual_academic_user', Session::get('user_id'))
              ->delete();
           // Insert preference into database
           DB::table('preference_casual_academic')->insert(
                ['preference_casual_academic_tutorial' => $preference_casual_academic_tutorial_1,
                 'preference_casual_academic_user' => Session::get('user_id'),
                 'preference_casual_academic_rank' => 1]
            );
           DB::table('preference_casual_academic')->insert(
                ['preference_casual_academic_tutorial' => $preference_casual_academic_tutorial_2,
                 'preference_casual_academic_user' => Session::get('user_id'),
                 'preference_casual_academic_rank' => 2]
            );
           DB::table('preference_casual_academic')->insert(
                ['preference_casual_academic_tutorial' => $preference_casual_academic_tutorial_3,
                 'preference_casual_academic_user' => Session::get('user_id'),
                 'preference_casual_academic_rank' => 3]
            );
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

    public function UosPageTimesheetStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $week_ids = $request->input('week_ids');
        $schedule_name = $request->input('schedule_name');
        $schedule_is_marking = $request->input('schedule_is_marking');
        $schedule_user = $request->input('schedule_user');
        $schedule_uos = $request->input('schedule_uos');
        $schedule_actual_duration = $request->input('schedule_actual_duration');
        // Start transactions
        DB::beginTransaction();
        try{
            foreach($week_ids as $week_id){
                // get tutorial info
                $temp_week = DB::table('week')
                               ->where('week_id', $week_id)
                               ->first();
                // Insert semester into database
                DB::table('schedule')->insert(['schedule_name' => $schedule_name,
                                               'schedule_user' => $schedule_user,
                                               'schedule_uos' => $schedule_uos,
                                               'schedule_week' => $week_id,
                                               'schedule_is_marking' => $schedule_is_marking,
                                               'schedule_allocated_duration' => 0,
                                               'schedule_actual_duration' => $schedule_actual_duration,
                                               'schedule_start_date' => $temp_week->week_start_date,
                                               'schedule_due_date' => $temp_week->week_end_date,
                                               'schedule_remark' => "",
                                               'schedule_status' => 2,
                                               'schedule_create_user' => Session::get('user_id'),
                                               'schedule_last_edit_user' => Session::get('user_id')]);
            }
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

    public function UosPageTimesheetUpdate(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $schedule_id = $request->input('schedule_id');
        $schedule_actual_duration = $request->input('schedule_actual_duration');
        // Start transactions
        DB::beginTransaction();
        try{
            // Get schedule info
            $db_schedule =  DB::table('schedule')
                              ->where('schedule_id', $schedule_id)
                              ->first();
            $schedule_status = 3;
            if($db_schedule->schedule_allocated_duration<$schedule_actual_duration){
                $schedule_status = 2;
            }
            // Update schedule status
            DB::table('schedule')
              ->where('schedule_id', $schedule_id)
              ->update(['schedule_actual_duration' => $schedule_actual_duration, 'schedule_status' => $schedule_status]);
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
