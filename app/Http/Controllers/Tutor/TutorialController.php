<?php
namespace App\Http\Controllers\Tutor;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TutorialController extends Controller
{

    public function tutorial(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        // get my tutorials information start
        $db_tutorials = DB::table('tutorial_casual_academic')
                          ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                          ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                          ->where('tutorial_casual_academic_user', Session::get('user_id'))
                          ->orderBy('tutorial_day_in_week', 'asc')
                          ->orderBy('tutorial_start_time', 'asc')
                          ->orderBy('tutorial_id', 'asc')
                          ->get();
        $array_tutorials = array();
        foreach($db_tutorials as $db_tutorial){
            $temp = array();
            $temp['uos_code'] = $db_tutorial->uos_code;
            $temp['uos_name'] = $db_tutorial->uos_name;
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

        // return view
        return view('/tutor/tutorial/tutorial', ['array_tutorials' => $array_tutorials]);
    }

}
