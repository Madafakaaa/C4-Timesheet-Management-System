<?php
namespace App\Http\Controllers;

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
        return view('/uos', ['db_semesters' => $db_semesters, 'db_uoses' => $db_uoses]);
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
        return redirect("/uos")
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
        // get all tutorials
        $db_tutorials = DB::table('tutorial')
                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                          ->where('tutorial_uos', $uos_id)
                          ->get();

        // get all users exclude tutors
        $tutor_ids=array();
        foreach($db_tutors as $db_tutor){
            $tutor_ids[] = $db_tutor->user_id;
        }
        $db_users = DB::table('user')
                      ->whereNotIn('user_id', $tutor_ids)
                      ->where('user_is_available', 1)
                      ->get();
        // return view
        return view('/uosPage', ['db_uos' => $db_uos, 'db_coordinators' => $db_coordinators, 'db_tutors' => $db_tutors, 'db_tutorials' => $db_tutorials, 'db_users' => $db_users]);
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
}
