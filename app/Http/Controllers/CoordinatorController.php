<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CoordinatorController extends Controller
{
    /**
     * Read casualAcademic info
     * URL: GET /casualAcademic
     */
    public function Coordinator(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $db_coordinator = DB::select('SELECT * from user where user_role % 2 = 0 and user_is_available = 1;');
        // 返回列表视图
        return view('/coordinator', ['db_coordinator' => $db_coordinator]);
    }

    public function CoordinatorCreate(){
        // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        return view('/coordinatorCreate');
    }

        public function semesterStore(Request $request){
             // Check login status
            if(!Session::has('login')){
                return loginExpired();  // Have not logged in, redirect to the login page.
            }
            // Get the form input
            $coordinator_name = $request->input('semester_name');
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
