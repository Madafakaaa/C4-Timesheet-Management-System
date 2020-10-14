<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class SemesterController extends Controller
{
    /**
     * Read semester info
     * URL: GET /semester
     */
    public function semester(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $db_semesters = DB::table('semester')
                          ->where('semester_is_available', 1)
                          ->orderBy('semester_id', 'asc')
                          ->get();
        // 返回列表视图
        return view('/semester', ['db_semesters' => $db_semesters]);
    }

    /**
     * Create new semester
     * URL: GET /semester/create
     */
    public function semesterCreate(){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        return view('/semesterCreate');
    }

    /**
     * Store new semester
     * URL: POST /semester/store
     */
    public function semesterStore(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $semester_name = $request->input('semester_name');
        $semester_start = $request->input('semester_start');
        $week_names = $request->input('week_name');
        //
        $semester_duration = count($week_names);
        $semester_end = date('Y-m-d', strtotime ("+".(7*$semester_duration-1)." day", strtotime($semester_start)));
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert semester into database
           $semester_id = DB::table('semester')->insertGetId(
                ['semester_name' => $semester_name,
                 'semester_start' => $semester_start,
                 'semester_end' => $semester_end,
                 'semester_duration' => $semester_duration,
                 'semester_create_user' => Session::get('user_id'),
                 'semester_last_edit_user' => Session::get('user_id')]
            );
           // Insert weeks
           $week_start_date = $semester_start;
           foreach($week_names as $week_name){
               $week_end_date = date('Y-m-d', strtotime ("+6 day", strtotime($week_start_date)));
               DB::table('week')->insertGetId(
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
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return $e;
            return back()
                   ->with(['notify' => true,
                           'type' => 'danger',
                           'title' => 'Exception!',
                           'message' => 'Exception!']);
        }
        // Commit transactions
        DB::commit();
        // Redirect to the semester page
        return redirect("/semester")
               ->with(['notify' => true,
                       'type' => 'success',
                       'title' => 'Success!',
                       'message' => 'Success!']);
    }

    /**
     * Delete Semester
     * URL: GET /company/department/delete
     */
    public function semesterDelete(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get semester id
        $semester_id=$request->input('semester_id');
        // Start transactions
        DB::beginTransaction();
        try{
            // Update semester status
            DB::table('semester')
              ->where('semester_id', $semester_id)
              ->update(['semester_is_available' => 0]);
        }
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return redirect("/semester")
                   ->with(['notify' => true,
                           'type' => 'danger',
                           'title' => 'Exception!',
                           'message' => 'Exception!']);
        }
        // Commit transactions
        DB::commit();
        // Redirect to the semester page
        return redirect("/semester")
               ->with(['notify' => true,
                       'type' => 'success',
                       'title' => 'Success!',
                       'message' => 'Success!']);
    }

}
