<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class AdminUserController extends Controller
{
    /**
     * Read user info
     * URL: GET /AdminUser
     */
    public function AdminUser(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $db_users = DB::table('user')
            ->where('user_is_available', 1)
            ->get();
        // 返回列表视图
        return view('/adminUser', ['db_users' => $db_users]);
    }

    public function AdminUserCreate(Request $request){
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        return view('/adminUserCreate');
    }


    /**
     * Store new User
     * URL: POST /adminUser/store
     */
    public function AdminUserStore(Request $request){
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
        $user_is_casual_academic = $request->input('user_is_casual_academic');
        $user_is_uos_coordinator = $request->input('user_is_uos_coordinator');
        $user_is_deputy_hos = $request->input('user_is_deputy_hos');
        if($user_is_casual_academic){
            $user_is_casual_academic = 1;
        }else{
            $user_is_casual_academic = 0;
        }

        if($user_is_uos_coordinator){
            $user_is_uos_coordinator = 1;
        }else{
            $user_is_uos_coordinator = 0;
        }

        if($user_is_deputy_hos){
            $user_is_deputy_hos = 1;
        }else{
            $user_is_deputy_hos = 0;
        }

        $opertor = Session::get('user_id');

        if(DB::table('user')->where('user_id', $user_id)->where('user_is_available', 1)->exists()){
            return redirect("/adminUser/create")
                ->with(['notify' => true,
                    'type' => 'danger',
                    'title' => 'Exception!',
                    'message' => 'The User ID has been used!']);
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
                        'user_is_deputy_hos' => $user_is_deputy_hos,
                        'user_is_casual_academic' => $user_is_casual_academic,
                        'user_is_uos_coordinator' => $user_is_uos_coordinator,
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
                return redirect("/adminUser/create")
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
        return redirect("/adminUser")
            ->with(['notify' => true,
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Success!']);
    }

    public function AdminUserDelete(Request $request){
        // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // Get semester id
        $user_id=$request->input('user_id');
        if(DB::table('user')->where('user_id', $user_id)->where('user_is_administrator', 1)->where('user_is_available', 1)->exists()){
            return redirect("/adminUser")
                ->with(['notify' => true,
                    'type' => 'danger',
                    'title' => 'Exception!',
                    'message' => 'Administrator cannot be deleted!']);
        }else{
            DB::beginTransaction();
            try{
                // Update semester status
                DB::table('user')
                    ->where('user_id', $user_id)
                    ->update(['user_is_available' => 0,
                        'user_last_edit_user' => Session::get('user_id'),
                        'user_last_edit_time' => date('Y-m-d H:i:s'),
                    ]);
            }
                // Exception
            catch(Exception $e){
                // Transactions rollback
                DB::rollBack();
                return redirect("/adminUser")
                    ->with(['notify' => true,
                        'type' => 'danger',
                        'title' => 'Exception!',
                        'message' => 'Exception!']);
            }
            // Commit transactions
            DB::commit();
        }
        // Redirect to the semester page
        return redirect("/adminUser")
            ->with(['notify' => true,
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Success!']);
    }

    public function AdminUserEdit(Request $request){
        // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $user_id=$request->input('user_id');
        $type=$request->input('type');
        if(DB::table('user')->where('user_id', $user_id)->where('user_is_available', 1)->exists()){
            $db_user = DB::table('user')
                ->where('user_id', $user_id)
                ->where('user_is_available', 1)
                ->first();
            $user_is_casual_academic = $db_user->user_is_casual_academic;
            $user_is_uos_coordinator = $db_user->user_is_uos_coordinator;
            $user_is_deputy_hos = $db_user->user_is_deputy_hos;
            if($user_is_casual_academic){
                $user_is_casual_academic = 0;
            }else{
                $user_is_casual_academic = 1;
            }
            if($user_is_uos_coordinator){
                $user_is_uos_coordinator = 0;
            }else{
                $user_is_uos_coordinator = 1;
            }
            if($user_is_deputy_hos){
                $user_is_deputy_hos = 0;
            }else{
                $user_is_deputy_hos = 1;
            }

            DB::beginTransaction();
            try{
                if ( $type == 1){
                    DB::table('user')
                        ->where('user_id', $user_id)
                        ->update(['user_is_casual_academic' => $user_is_casual_academic,
                            'user_last_edit_user' => Session::get('user_id'),
                            'user_last_edit_time' => date('Y-m-d H:i:s'),
                        ]);
                }elseif ($type == 2){
                    DB::table('user')
                        ->where('user_id', $user_id)
                        ->update(['user_is_uos_coordinator' => $user_is_uos_coordinator,
                            'user_last_edit_user' => Session::get('user_id'),
                            'user_last_edit_time' => date('Y-m-d H:i:s'),
                        ]);
                }elseif ($type == 3){
                    DB::table('user')
                        ->where('user_id', $user_id)
                        ->update(['user_is_deputy_hos' => $user_is_deputy_hos,
                            'user_last_edit_user' => Session::get('user_id'),
                            'user_last_edit_time' => date('Y-m-d H:i:s'),
                        ]);
                }
                // Update semester status

            }
                // Exception
            catch(Exception $e){
                // Transactions rollback
                DB::rollBack();
                return redirect("/adminUser")
                    ->with(['notify' => true,
                        'type' => 'danger',
                        'title' => 'Exception!',
                        'message' => 'Exception!']);
            }
            // Commit transactions
            DB::commit();

        }
        // Redirect to the semester page
        return redirect("/adminUser")
            ->with(['notify' => true,
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Success!']);

    }

}
