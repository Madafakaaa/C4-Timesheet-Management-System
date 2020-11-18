<?php
namespace App\Http\Controllers\Coordinator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TutorController extends Controller
{
    /**
     * Read user info
     * URL: GET /user
     */
    public function tutor(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $db_users = DB::table('user')
                      ->where('user_is_available', 1)
                      ->get();
        // 返回列表视图
        return view('/coordinator/tutor/tutor', ['db_users' => $db_users]);
    }

    public function tutorCreate(Request $request){
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        return view('/coordinator/tutor/tutorCreate');
    }


    /**
     * Store new tutor
     * URL: POST /user/store
     */
    public function tutorStore(Request $request){
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
            return back()->with(['notify' => true,
                                'type' => 'danger',
                                'title' => 'Exception!',
                                'message' => 'Exception!']);
        }
        // Commit transactions
        DB::commit();
        // Redirect to the user page
        return redirect("/coordinator/tutor")
                ->with(['notify' => true,
                    'type' => 'success',
                    'title' => 'Success!',
                    'message' => 'Success!']);
    }


}
