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
        return $db_semesters;
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
        $semester_end = $request->input('semester_end');
        // Start transactions
        DB::beginTransaction();
        try{
           // Insert into database
           DB::table('semester')->insert(
                ['semester_name' => $semester_name,
                 'semester_start' => $semester_start,
                 'semester_end' => $semester_end,
                 'semester_create_user' => Session::get('user_id')]
            );
        }
        // Exception
        catch(Exception $e){
            // Transactions rollback
            DB::rollBack();
            return redirect("/semester/create")
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
