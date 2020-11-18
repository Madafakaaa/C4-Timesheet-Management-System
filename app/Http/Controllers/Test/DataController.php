<?php
namespace App\Http\Controllers\Test;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class DataController extends Controller
{

    /**
     * Generate test data
     * URL: GET /test/data/generate
     */
    public function dataGenerate(){
        // Start transactions
        DB::beginTransaction();
        try{
            // --------------------------------- Create users ---------------------------------
            $user_names = array(
                'Christopher','Ryan','Ethan','John','Zoey','Sarah','Michelle','Samantha',
                'Liberty','Faye','Carrie','Elsie','Crystal','Maria','Kiera','Aminah',
                'Jennifer ','Clara','Kara','Gloria','Josie','Rosemary','Traci','Megan',
                'Eve ','Aimee','Lisa','Jessica','Sara','Lois','Nadia','Monica',
                'Zara ','Orla','Summer','Jasmine','Tommy','Mason','Dorothy','Amelia',
                'Barbara ','Nettie','Sandra','Susan','Elise','Alicia','Autumn','Cerys',
                'Adrian ','Amirah','Vanessa','Felicity','Phoebe','Hannah','Anita','Polly',
                'Paige ','Freya','Annabel','Rosa','Aiden','Maya','Verity','Jose',
                'Stella ','Jay','Madeline','Holly','Victoria','Savannah','Anya','Erica',
                'Rachel ','Henry','Felix','Tobias','Jim','James','Russell','Osian',
                'Bilal ','Amir','Faith','Alvin','Mitchell','Nathan','Owen','Andre',
                'Luis ','Zachary','Justin','Milo','Cain','Sana','Dale','Dexter',
                'Harry ','Anita','Dominic','Homer','Kyran','Callum','Claudia','Calvin',
                'Jodie ','Carl','Jack','Sebastian','Farhan','Timothy','Eddie','Alfie',
                'Rebekah ','Rocco','Gethin','Jackson','Ewan','Seth','Tyler','Chad',
                'Terry ','Tyler','Barrett','Ramos','Mason','Mckinney','Kramer','Goodwin',
                'Oliver ','Tucker','Hodges','Hopkins','Ali','Chandler','Hunter','Macdonald',
                'Jenkins ','Nelson','Simon','Rojas','Jensen','Zimmerman','Bauer','Cox',
            );
            $user_titles = array('Mr','Miss','Dr','Mrs');
            for($i=1;$i<=900;$i++){
                DB::table('user')->insert(
                [
                    'user_id' => "test".sprintf("%04d", $i),
                    'user_password' => "000000",
                    'user_first_name' => $user_names[mt_rand(0, sizeof($user_names) - 1)],
                    'user_last_name' => $user_names[mt_rand(0, sizeof($user_names) - 1)],
                    'user_title' => $user_titles[mt_rand(0, sizeof($user_titles) - 1)],
                    'user_birthday' => date('Y-m-d'),
                    'user_email' => "test".sprintf("%04d", $i)."@uni.sydney.edu.au",
                    'user_is_administrator' => 0,
                    'user_is_deputy_hos' => mt_rand(0,1),
                    'user_is_casual_academic' => mt_rand(0,1),
                    'user_is_uos_coordinator' => mt_rand(0,1),
                    'user_is_available' => 1,
                    'user_create_user' => Session::get('user_id'),
                    'user_create_time' => date('Y-m-d H:i:s'),
                    'user_last_edit_user' => Session::get('user_id'),
                    'user_last_edit_time' => date('Y-m-d H:i:s')
                ]);
            }
            // --------------------------------- Create 2 semesters and weeks ---------------------------------
            $semester_names = array('2020 Semester 1','2020 Semester 1 Early','2020 Semester 2','2020 Semester 2 Early');
            $week_names = array('week 1','week 2','week 3','week 4','week 5','week 6',
                                'week 7','midterm break','week 8','week 9','week 10','week 11',
                                'week 12','exam prep','exam week 1','exam week 2');
            foreach($semester_names as $semester_name){
                $semester_duration = count($week_names);
                $semester_start = date('Y-m-d', strtotime("2020-".sprintf("%02d", mt_rand(1,11))."-".sprintf("%02d", mt_rand(1,11))));
                $semester_end = date('Y-m-d', strtotime ("+".(7*$semester_duration-1)." day", strtotime($semester_start)));
                $semester_id = DB::table('semester')->insertGetId(
                    ['semester_name' => $semester_name,
                     'semester_start' => $semester_start,
                     'semester_end' => $semester_end,
                     'semester_duration' => $semester_duration,
                     'semester_create_user' => Session::get('user_id'),
                     'semester_last_edit_user' => Session::get('user_id')]
                 );
                // create weeks
                $week_start_date = $semester_start;
                foreach($week_names as $week_name){
                    $week_end_date = date('Y-m-d', strtotime ("+6 day", strtotime($week_start_date)));
                    DB::table('week')->insert(
                       ['week_semester' => $semester_id,
                        'week_name' => $week_name,
                        'week_start_date' => $week_start_date,
                        'week_end_date' => $week_end_date,
                        'week_create_user' => Session::get('user_id'),
                        'week_last_edit_user' => Session::get('user_id')]
                    );
                    $week_start_date = date('Y-m-d', strtotime ("+7 day", strtotime($week_start_date)));
                }
            }
            // --------------------------------- Create unit of studies, tutorials and choose coordinators and tutors ---------------------------------
            // Read semesters
            $db_semesters = DB::table('semester')->orderBy('semester_id', 'asc')->get();
            // Prepare uos info
            $unit_of_studies = array(
                                       array('INFO1105','Data Structures'),
                                       array('INFO2315','Introduction to IT Security'),
                                       array('COMP2129','Operating Systems and Machine Principles'),
                                       array('ELEC1601','Foundations of Computer Systems'),
                                       array('COMP2022','Formal Languages and Logic'),
                                       array('COMP2007','Algorithms and Complexity'),
                                       array('INFO3315','Human-Computer Interaction'),
                                       array('COMP2129','Operating Systems and Machine Principles'),
                                       array('INFO2110','Systems Analysis and Modelling'),
                                       array('INFO2120','Database Systems 1'),
                                       array('INFO3404','Database Systems 2'),
                                       array('COMP3221','Distributed Systems'),
                                       array('COMP3308','Introduction to Artificial Intelligence'),
                                       array('INFO3220','Object Oriented Design'),
                                       array('SOFT3413','Software Development Project'),
                                       array('COMP5206','Information Technologies and Systems'),
                                       array('INFO5990','Professional Practice in IT'),
                                       array('INFO5992','Understanding IT Innovations'),
                                       array('COMP5047','Pervasive Computing'),
                                       array('COMP5318','	Machine Learning and Data Mining'),
                                       array('INFO5992','Understanding IT Innovations'),
                                       array('COMP5703','IT Capstone Project'),
                                     );
            // Prepare tutorial info
            $tutorials = array(
                                 array('Mon10A','1','10:00','12:00','SIT211'),array('Mon10B','1','10:00','12:00','SIT212'),
                                 array('Mon13A','1','13:00','15:00','SIT214'),array('Mon13B','1','13:00','15:00','SIT215'),
                                 array('Mon15A','1','15:00','17:00','SIT217'),array('Mon15B','1','15:00','17:00','SIT218'),

                                 array('Tue10A','2','10:00','12:00','SIT211'),array('Tue10B','2','10:00','12:00','SIT212'),
                                 array('Tue13A','2','13:00','15:00','SIT214'),array('Tue13B','2','13:00','15:00','SIT215'),
                                 array('Tue15A','2','15:00','17:00','SIT217'),array('Tue15B','2','15:00','17:00','SIT218'),

                                 array('Wed10A','3','10:00','12:00','SIT211'),array('Wed10B','3','10:00','12:00','SIT212'),
                                 array('Wed13A','3','13:00','15:00','SIT214'),array('Wed13B','3','13:00','15:00','SIT215'),
                                 array('Wed15A','3','15:00','17:00','SIT217'),array('Wed15B','3','15:00','17:00','SIT218'),

                                 array('Thu10A','4','10:00','12:00','SIT211'),array('Thu10B','4','10:00','12:00','SIT212'),
                                 array('Thu13A','4','13:00','15:00','SIT214'),array('Thu13B','4','13:00','15:00','SIT215'),
                                 array('Thu15A','4','15:00','17:00','SIT217'),array('Thu15B','4','15:00','17:00','SIT218'),

                                 array('Fri10A','5','10:00','12:00','SIT211'),array('Fri10B','5','10:00','12:00','SIT212'),
                                 array('Fri13A','5','13:00','15:00','SIT214'),array('Fri13B','5','13:00','15:00','SIT215'),
                                 array('Fri15A','5','15:00','17:00','SIT217'),array('Fri15B','5','15:00','17:00','SIT218'),
                               );
            foreach($db_semesters as $db_semester){
                foreach($unit_of_studies as $unit_of_study){
                    $uos_id = DB::table('uos')->insertGetId(
                        ['uos_name' => $unit_of_study[1],
                         'uos_code' => $unit_of_study[0],
                         'uos_semester' => $db_semester->semester_id,
                         'uos_description' => $db_semester->semester_name." - ".$unit_of_study[0]." ".$unit_of_study[1],
                         'uos_create_user' => Session::get('user_id'),
                         'uos_last_edit_user' => Session::get('user_id')]
                    );
                    // Choose one random coordinator
                    $rand_coordinator = DB::table('user')->where('user_is_uos_coordinator', 1)->inRandomOrder()->first();
                    // Create uos coordinator relationship
                    DB::table('uos_coordinator')->insert(
                        ['uos_coordinator_user' => $rand_coordinator->user_id,
                         'uos_coordinator_uos' => $uos_id,
                         'uos_coordinator_create_user' => Session::get('user_id'),
                         'uos_coordinator_last_edit_user' => Session::get('user_id')]
                    );
                    // Choose one random coordinator
                    $rand_coordinator = DB::table('user')->where('user_is_uos_coordinator', 1)->inRandomOrder()->first();
                    // Create uos coordinator relationship
                    DB::table('uos_coordinator')->insert(
                        ['uos_coordinator_user' => $rand_coordinator->user_id,
                         'uos_coordinator_uos' => $uos_id,
                         'uos_coordinator_create_user' => Session::get('user_id'),
                         'uos_coordinator_last_edit_user' => Session::get('user_id')]
                    );
                    // Choose 10 to 20 random tutors
                    $rand_tutors = DB::table('user')->where('user_is_casual_academic', 1)->inRandomOrder()->limit(mt_rand(10,20))->get();
                    $temp_tutors = array();
                    foreach($rand_tutors as $rand_tutor){
                        // Create uos tutor relationship
                        DB::table('uos_casual_academic')->insert(
                              ['uos_casual_academic_user' => $rand_tutor->user_id,
                               'uos_casual_academic_uos' => $uos_id,
                               'uos_casual_academic_type' => 1,
                               'uos_casual_academic_create_user' => Session::get('user_id'),
                               'uos_casual_academic_last_edit_user' => Session::get('user_id')]
                        );
                        $temp_tutors[] = $rand_tutor->user_id;
                    }
                    // Create tutorials
                    foreach($tutorials as $tutorial){
                        $tutorial_id = DB::table('tutorial')->insertGetId(
                            ['tutorial_uos' => $uos_id,
                             'tutorial_name' => $tutorial[0],
                             'tutorial_day_in_week' => $tutorial[1],
                             'tutorial_start_time' => $tutorial[2],
                             'tutorial_end_time' => $tutorial[3],
                             'tutorial_duration' => 2,
                             'tutorial_location' => $tutorial[4],
                             'tutorial_create_user' => Session::get('user_id'),
                             'tutorial_last_edit_user' => Session::get('user_id')]
                        );
                        foreach(array_rand($temp_tutors, 2) as $tutorial_tutor_key){
                            DB::table('tutorial_casual_academic')->insert(
                                ['tutorial_casual_academic_tutorial' => $tutorial_id,
                                 'tutorial_casual_academic_user' => $temp_tutors[$tutorial_tutor_key]]
                            );
                        }
                    }
                }
            }
            // --------------------------------- Create time sheets ---------------------------------
            // Create newly created schedules (status 0)
            $rand_tutors = DB::table('user')
                             ->join('tutorial_casual_academic', 'tutorial_casual_academic.tutorial_casual_academic_user', '=', 'user.user_id')
                             ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                             ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                             ->join('semester', 'semester.semester_id', '=', 'uos.uos_semester')
                             ->join('week', 'semester.semester_id', '=', 'week.week_semester')
                             ->where('user_is_casual_academic', 1)
                             ->inRandomOrder()
                             ->limit(500)
                             ->get();
            foreach($rand_tutors as $rand_tutor){
                  DB::table('schedule')->insert(['schedule_name' => "Test schedule - 0",
                                                 'schedule_user' => $rand_tutor->user_id,
                                                 'schedule_uos' => $rand_tutor->uos_id,
                                                 'schedule_week' => $rand_tutor->week_id,
                                                 'schedule_is_marking' => 0,
                                                 'schedule_allocated_duration' => 2,
                                                 'schedule_actual_duration' => 0,
                                                 'schedule_start_date' => date('Y-m-d'),
                                                 'schedule_due_date' => date('Y-m-d'),
                                                 'schedule_remark' => "",
                                                 'schedule_status' => 0,
                                                 'schedule_create_user' => Session::get('user_id'),
                                                 'schedule_last_edit_user' => Session::get('user_id')]);
            }
            // Create allocated schedules (status 1)
            $rand_tutors = DB::table('user')
                             ->join('tutorial_casual_academic', 'tutorial_casual_academic.tutorial_casual_academic_user', '=', 'user.user_id')
                             ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                             ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                             ->join('semester', 'semester.semester_id', '=', 'uos.uos_semester')
                             ->join('week', 'semester.semester_id', '=', 'week.week_semester')
                             ->where('user_is_casual_academic', 1)
                             ->inRandomOrder()
                             ->limit(1000)
                             ->get();
            foreach($rand_tutors as $rand_tutor){
                  DB::table('schedule')->insert(['schedule_name' => "Test schedule - 1",
                                                 'schedule_user' => $rand_tutor->user_id,
                                                 'schedule_uos' => $rand_tutor->uos_id,
                                                 'schedule_week' => $rand_tutor->week_id,
                                                 'schedule_is_marking' => 0,
                                                 'schedule_allocated_duration' => 2,
                                                 'schedule_actual_duration' => 0,
                                                 'schedule_start_date' => date('Y-m-d'),
                                                 'schedule_due_date' => date('Y-m-d'),
                                                 'schedule_remark' => "",
                                                 'schedule_status' => 1,
                                                 'schedule_create_user' => Session::get('user_id'),
                                                 'schedule_last_edit_user' => Session::get('user_id')]);
            }
            // Create pending schedules (status 2)
            $rand_tutors = DB::table('user')
                             ->join('tutorial_casual_academic', 'tutorial_casual_academic.tutorial_casual_academic_user', '=', 'user.user_id')
                             ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                             ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                             ->join('semester', 'semester.semester_id', '=', 'uos.uos_semester')
                             ->join('week', 'semester.semester_id', '=', 'week.week_semester')
                             ->where('user_is_casual_academic', 1)
                             ->inRandomOrder()
                             ->limit(500)
                             ->get();
            foreach($rand_tutors as $rand_tutor){
                  DB::table('schedule')->insert(['schedule_name' => "Test schedule - 2",
                                                 'schedule_user' => $rand_tutor->user_id,
                                                 'schedule_uos' => $rand_tutor->uos_id,
                                                 'schedule_week' => $rand_tutor->week_id,
                                                 'schedule_is_marking' => 0,
                                                 'schedule_allocated_duration' => 2,
                                                 'schedule_actual_duration' => 3,
                                                 'schedule_start_date' => date('Y-m-d'),
                                                 'schedule_due_date' => date('Y-m-d'),
                                                 'schedule_remark' => "",
                                                 'schedule_status' => 2,
                                                 'schedule_create_user' => Session::get('user_id'),
                                                 'schedule_last_edit_user' => Session::get('user_id')]);
            }
            $rand_tutors = DB::table('user')
                             ->join('tutorial_casual_academic', 'tutorial_casual_academic.tutorial_casual_academic_user', '=', 'user.user_id')
                             ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                             ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                             ->join('semester', 'semester.semester_id', '=', 'uos.uos_semester')
                             ->join('week', 'semester.semester_id', '=', 'week.week_semester')
                             ->where('user_is_casual_academic', 1)
                             ->inRandomOrder()
                             ->limit(500)
                             ->get();
            foreach($rand_tutors as $rand_tutor){
                  DB::table('schedule')->insert(['schedule_name' => "Test schedule - 2",
                                                 'schedule_user' => $rand_tutor->user_id,
                                                 'schedule_uos' => $rand_tutor->uos_id,
                                                 'schedule_week' => $rand_tutor->week_id,
                                                 'schedule_is_marking' => 0,
                                                 'schedule_allocated_duration' => 0,
                                                 'schedule_actual_duration' => 1,
                                                 'schedule_start_date' => date('Y-m-d'),
                                                 'schedule_due_date' => date('Y-m-d'),
                                                 'schedule_remark' => "",
                                                 'schedule_status' => 2,
                                                 'schedule_create_user' => Session::get('user_id'),
                                                 'schedule_last_edit_user' => Session::get('user_id')]);

            }
            // Create allocated schedules (status 3)
            $rand_tutors = DB::table('user')
                             ->join('tutorial_casual_academic', 'tutorial_casual_academic.tutorial_casual_academic_user', '=', 'user.user_id')
                             ->join('tutorial', 'tutorial.tutorial_id', '=', 'tutorial_casual_academic.tutorial_casual_academic_tutorial')
                             ->join('uos', 'tutorial.tutorial_uos', '=', 'uos.uos_id')
                             ->join('semester', 'semester.semester_id', '=', 'uos.uos_semester')
                             ->join('week', 'semester.semester_id', '=', 'week.week_semester')
                             ->where('user_is_casual_academic', 1)
                             ->inRandomOrder()
                             ->limit(2000)
                             ->get();
            foreach($rand_tutors as $rand_tutor){
                  DB::table('schedule')->insert(['schedule_name' => "Test schedule - 1",
                                                 'schedule_user' => $rand_tutor->user_id,
                                                 'schedule_uos' => $rand_tutor->uos_id,
                                                 'schedule_week' => $rand_tutor->week_id,
                                                 'schedule_is_marking' => 0,
                                                 'schedule_allocated_duration' => 2,
                                                 'schedule_actual_duration' => 2,
                                                 'schedule_start_date' => date('Y-m-d'),
                                                 'schedule_due_date' => date('Y-m-d'),
                                                 'schedule_remark' => "",
                                                 'schedule_status' => 3,
                                                 'schedule_create_user' => Session::get('user_id'),
                                                 'schedule_last_edit_user' => Session::get('user_id')]);
            }
        }
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return $e;
        }
        // Commit transactions
        DB::commit();
        // Return result
        return "Data Generated!";
    }

}
