<?php
namespace App\Http\Controllers\Administrator;

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
                      ->where('uos_is_available', 1)
                      ->where('semester_is_available', 1)
                      ->orderBy('uos_id', 'asc')
                      ->get();
        // get all semesters
        $db_semesters = DB::table('semester')
                          ->where('semester_is_available', 1)
                          ->orderBy('semester_id', 'asc')
                          ->get();
        // return view
        return view('/administrator/uos/uos', ['db_semesters' => $db_semesters, 'db_uoses' => $db_uoses]);
    }

    public function uosStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $uos_name = $request->input('uos_name');
        $uos_code = $request->input('uos_code');
        $uos_semester = $request->input('uos_semester');
        $uos_description = $request->input('uos_description');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('uos')->insert(
                ['uos_name' => $uos_name,
                 'uos_code' => $uos_code,
                 'uos_semester' => $uos_semester,
                 'uos_description' => $uos_description,
                 'uos_create_user' => Session::get('user_id'),
                 'uos_last_edit_user' => Session::get('user_id')]
            );
        }
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return back()
                   ->with(['notify' => true,
                           'type' => 'danger',
                           'title' => 'Exception!',
                           'message' => 'Exception!']);
        }
        // Commit transactions
        DB::commit();
        // Redirect to the semester page
        return back()
               ->with(['notify' => true,
                       'type' => 'success',
                       'title' => 'Success!',
                       'message' => 'Success!']);
    }


    public function UosPage(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $uos_id = $request->input('id');
        // get all uos
        $db_uos = DB::table('uos')
                    ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                    ->where('uos_id', $uos_id)
                    ->first();
        // get all coordinators
        $db_coordinators = DB::table('uos_coordinator')
                    ->join('uos', 'uos_coordinator.uos_coordinator_uos', '=', 'uos.uos_id')
                    ->join('user', 'uos_coordinator.uos_coordinator_user', '=', 'user.user_id')
                    ->where('uos_coordinator_uos', $uos_id)
                    ->get();
        // get all tutors
        $db_tutors = DB::table('uos_casual_academic')
                    ->join('uos', 'uos_casual_academic.uos_casual_academic_uos', '=', 'uos.uos_id')
                    ->join('user', 'uos_casual_academic.uos_casual_academic_user', '=', 'user.user_id')
                    ->where('uos_casual_academic_uos', $uos_id)
                    ->get();
        $array_tutors = array();
        foreach($db_tutors as $db_tutor){
            $temp = array();
            $temp['user_id'] = $db_tutor->user_id;
            $temp['user_first_name'] = $db_tutor->user_first_name;
            $temp['user_last_name'] = $db_tutor->user_last_name;
            $temp['user_email'] = $db_tutor->user_email;
            // get tutor's tutorials
            $temp['tutorials'] = array();
            $temp_tutorials = DB::table('tutorial_casual_academic')
                                ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                                ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                                ->where('tutorial_uos', $uos_id)
                                ->where('tutorial_casual_academic_user', $db_tutor->user_id)
                                ->orderBy('tutorial_day_in_week', 'asc')
                                ->orderBy('tutorial_start_time', 'asc')
                                ->orderBy('tutorial_id', 'asc')
                                ->get();
            foreach($temp_tutorials as $temp_tutorial){
                $temp['tutorials'][] = array("tutorial_name" => $temp_tutorial->tutorial_name,
                                             "tutorial_day_in_week" => $temp_tutorial->tutorial_day_in_week);
            }
            $array_tutors[] = $temp;
        }

        // get all tutorials information start
        $db_tutorials = DB::table('tutorial')
                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                          ->where('tutorial_uos', $uos_id)
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
            // get candidates with preference
            $temp['candidate_ids'] = array();
            $temp['candidates'] = DB::table('preference_casual_academic')
                                     ->join('tutorial', 'preference_casual_academic.preference_casual_academic_tutorial', '=', 'tutorial.tutorial_id')
                                     ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                                     ->join('user', 'preference_casual_academic.preference_casual_academic_user', '=', 'user.user_id')
                                     ->where('tutorial_id', '=', $db_tutorial->tutorial_id)
                                     ->whereNotIn('user_id', $temp['tutor_ids'])
                                     ->orderBy('preference_casual_academic_rank', 'asc')
                                     ->get();
            foreach($temp['candidates'] as $candidate){
                $temp['candidate_ids'][] = $candidate->user_id;
            }
            // get candidates without preference
            $temp['other_candidates'] = DB::table('uos_casual_academic')
                                          ->join('uos', 'uos_casual_academic.uos_casual_academic_uos', '=', 'uos.uos_id')
                                          ->join('user', 'uos_casual_academic.uos_casual_academic_user', '=', 'user.user_id')
                                          ->where('uos_casual_academic_uos', $uos_id)
                                          ->whereNotIn('user_id', $temp['tutor_ids'])
                                          ->whereNotIn('user_id', $temp['candidate_ids'])
                                          ->get();
            $array_tutorials[] = $temp;
        }
        // get all tutorials information end

        // get current tutor and coordinators' id
        $tutor_ids = array();
        $coordinator_ids = array();
        foreach($db_tutors as $db_tutor){
            $tutor_ids[] = $db_tutor->user_id;
        }
        foreach($db_coordinators as $db_coordinator){
            $coordinator_ids[] = $db_coordinator->user_id;
        }
        // get user candidate for tutor
        $tutor_users = DB::table('user')
                         ->whereNotIn('user_id', $tutor_ids)
                         ->where('user_is_available', 1)
                         ->where('user_is_casual_academic', 1)
                         ->get();
        // get users candidate for coordinator
        $coordinator_users = DB::table('user')
                               ->whereNotIn('user_id', $coordinator_ids)
                               ->where('user_is_available', 1)
                               ->where('user_is_uos_coordinator', 1)
                               ->get();
        // return view
        return view('/administrator/uos/uosPage', ['db_uos' => $db_uos,
                                                   'db_coordinators' => $db_coordinators,
                                                   'array_tutors' => $array_tutors,
                                                   'array_tutorials' => $array_tutorials,
                                                   'tutor_users' => $tutor_users,
                                                   'coordinator_users' => $coordinator_users]);
    }

    public function UosPageTutorStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $uos_casual_academic_user = $request->input('uos_casual_academic_user');
        $uos_casual_academic_uos = $request->input('uos_casual_academic_uos');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('uos_casual_academic')->insert(
                ['uos_casual_academic_user' => $uos_casual_academic_user,
                 'uos_casual_academic_uos' => $uos_casual_academic_uos,
                 'uos_casual_academic_type' => 1,
                 'uos_casual_academic_create_user' => Session::get('user_id'),
                 'uos_casual_academic_last_edit_user' => Session::get('user_id')]
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

    public function UosPageTutorDelete(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $uos_casual_academic_user = $request->input('user_id');
        $uos_casual_academic_uos = $request->input('uos_id');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('uos_casual_academic')
           ->where('uos_casual_academic_user', $uos_casual_academic_user)
           ->where('uos_casual_academic_uos', $uos_casual_academic_uos)
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

    public function UosPageTutorialStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $tutorial_uos = $request->input('tutorial_uos');
        $tutorial_name = $request->input('tutorial_name');
        $tutorial_day_in_week = $request->input('tutorial_day_in_week');
        $tutorial_start_time = $request->input('tutorial_start_time');
        $tutorial_end_time = $request->input('tutorial_end_time');
        $tutorial_location = $request->input('tutorial_location');
        // calculate tutorial duration
        $Time_List_a1=explode(":",$tutorial_start_time);
        $Time_List_a2=explode(":",$tutorial_end_time);
        $tutorial_duration = round( ( 60 * ( intval($Time_List_a2[0])-intval($Time_List_a1[0]) ) + ( intval($Time_List_a2[1])-intval($Time_List_a1[1])))/60, 1 );
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('tutorial')->insert(
                ['tutorial_uos' => $tutorial_uos,
                 'tutorial_name' => $tutorial_name,
                 'tutorial_day_in_week' => $tutorial_day_in_week,
                 'tutorial_start_time' => $tutorial_start_time,
                 'tutorial_end_time' => $tutorial_end_time,
                 'tutorial_duration' => $tutorial_duration,
                 'tutorial_location' => $tutorial_location,
                 'tutorial_create_user' => Session::get('user_id'),
                 'tutorial_last_edit_user' => Session::get('user_id')]
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

    public function UosPageTutorialDelete(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $tutorial_id = $request->input('tutorial_id');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('tutorial')
           ->where('tutorial_id', $tutorial_id)
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

    public function UosPageCoordinatorStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $uos_coordinator_user = $request->input('uos_coordinator_user');
        $uos_coordinator_uos = $request->input('uos_coordinator_uos');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('uos_coordinator')->insert(
                ['uos_coordinator_user' => $uos_coordinator_user,
                 'uos_coordinator_uos' => $uos_coordinator_uos,
                 'uos_coordinator_create_user' => Session::get('user_id'),
                 'uos_coordinator_last_edit_user' => Session::get('user_id')]
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

    public function UosPageCoordinatorDelete(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $uos_coordinator_user = $request->input('user_id');
        $uos_coordinator_uos = $request->input('uos_id');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('uos_coordinator')
           ->where('uos_coordinator_user', $uos_coordinator_user)
           ->where('uos_coordinator_uos', $uos_coordinator_uos)
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

    public function UosPageTutorialTutorStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $tutorial_casual_academic_tutorial = $request->input('tutorial_casual_academic_tutorial');
        $tutorial_casual_academic_user = $request->input('tutorial_casual_academic_user');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           DB::table('tutorial_casual_academic')->insert(
                ['tutorial_casual_academic_tutorial' => $tutorial_casual_academic_tutorial,
                 'tutorial_casual_academic_user' => $tutorial_casual_academic_user]
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

    public function UosPageTutorTimeSheet(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the get parameter
        $user_id = $request->input('user_id');
        $uos_id = $request->input('uos_id');
        // get uos info
        $db_uos = DB::table('uos')
                    ->join('semester', 'uos.uos_semester', '=', 'semester.semester_id')
                    ->where('uos_id', $uos_id)
                    ->first();
        // get user info
        $db_user = DB::table('user')
                    ->where('user_id', $user_id)
                    ->first();
        // get user tutorials
        $db_tutorials = DB::table('tutorial_casual_academic')
                          ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                          ->where('tutorial_uos', $uos_id)
                          ->where('tutorial_casual_academic_user', $user_id)
                          ->orderBy('tutorial_day_in_week', 'asc')
                          ->orderBy('tutorial_start_time', 'asc')
                          ->orderBy('tutorial_id', 'asc')
                          ->get();
        // return view
        return view('/administrator/uos/uosPageTutorTimesheet', ['db_uos' => $db_uos, 'db_user' => $db_user, 'db_tutorials' => $db_tutorials]);
    }

}
