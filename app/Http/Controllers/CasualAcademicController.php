<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CasualAcademicController extends Controller
{
    /**
     * Read casualAcademic info
     * URL: GET /casualAcademic
     */
    public function CasualAcademic(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
//        $db_semesters = DB::table('semester')
//            ->where('semester_is_available', 1)
//            ->orderBy('semester_id', 'asc')
//            ->get();
        $db_casualAcademics = DB::table('user')
            ->where('user_is_casual_academic', 1)
            ->where('user_is_available', 1)
            ->get();
        // 返回列表视图
        return view('/casualAcademic', ['db_casualAcademics' => $db_casualAcademics]);
    }
    public function CasualAcademicCreate(Request $request){
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        return view('/casualAcademicCreate');
    }


    /**
     * Store new casualAcademic
     * URL: POST /casualAcademic/store
     */
    public function CasualAcademicStore(Request $request){
        // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get the form input
        $user_id = $request->input('user_id');
        $user_password = $request->input('user_password');
        $user_first_name = $request->input('user_first_name');
        $user_last_name = $request->input('user_last_name');
        $user_title = $request->input('user_title');
        $user_birthday = $request->input('user_birthday');
        $user_email = $request->input('user_email');

        $opertor = Session::get('user_id');

        if(DB::table('user')->where('user_id', $user_id)->where('user_is_available', 1)->exists()){
            DB::beginTransaction();
            try {
                DB::table('user')
                    ->where('user_id', $user_id)
                    ->update(['user_is_casual_academic' => 1,
                        'user_last_edit_user' => Session::get('user_id'),
                        'user_last_edit_time' => date('Y-m-d H:i:s'),
                        ]);
            }catch(Exception $e){
                // Transactions rollback
                DB::rollBack();
                return redirect("/casualAcademic/create")
                    ->with(['notify' => true,
                        'type' => 'danger',
                        'title' => 'Exception!',
                        'message' => 'Exception!']);
            }
            // Commit transactions
            DB::commit();

        }else{
            DB::beginTransaction();
            try{
                // Insert into database
                DB::table('user')->insert(
                    ['user_id' => $user_id,
                        'user_password' => $user_password,
                        'user_first_name' => $user_first_name,
                        'user_last_name' => $user_last_name,
                        'user_title' => $user_title,
                        'user_birthday' => $user_birthday,
                        'user_email' => $user_email,
                        'user_is_administrator' => 0,
                        'user_is_deputy_hos' => 0,
                        'user_is_casual_academic' => 1,
                        'user_is_uos_coordinator' => 0,
                        'user_is_available' => 1,
                        'user_create_user' => Session::get('user_id'),
                        'user_create_time' => date('Y-m-d H:i:s'),
                        'user_last_edit_user' => Session::get('user_id'),
                        'user_last_edit_time' => date('Y-m-d H:i:s')]
                );
            }
                // Exception
            catch(Exception $e){
                // Transactions rollback
                DB::rollBack();
                return redirect("/casualAcademic/create")
                    ->with(['notify' => true,
                        'type' => 'danger',
                        'title' => 'Exception!',
                        'message' => 'Exception!']);
            }
//            // Commit transactions
            DB::commit();
        }

        // Start transactions

        // Redirect to the semester page
        return redirect("/casualAcademic")
            ->with(['notify' => true,
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Success!']);
    }

}
