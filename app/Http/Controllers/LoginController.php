<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    /**
     * The login page
     * URL: GET /
     */
    public function index()
    {
        // Check login status
        if(Session::has('login')){
            // Have logged in, redirect to the home page.
            return redirect('/home');
        }else{
            // Have not logged in, redirect to the login view.
            return view('login');
        }
    }

    /**
     * Validate user info
     * URL: POST /login
     * @param  Request  $request
     * @param  $request->input('user_id'): User account
     * @param  $request->input('user_password'): User password
     */
    public function login(Request $request)
    {
        // Get the request input
        $request_user_id = $request->input('user_id');
        $request_user_password = $request->input('user_password');

        // No user found was in the database
        if(!DB::table('user')->where('user_id', $request_user_id)->where('user_is_available', 1)->exists()){
            return redirect('/')->with(['notify' => true,
                                        'type' => 'danger',
                                        'title' => 'Wrong user account or password!']);
        }

        // Validate the user password
        $db_user = DB::table('user')
                     ->where('user_id', $request_user_id)
                     ->where('user_is_available', 1)
                     ->first();
        $db_user_password = $db_user->user_password;

        // Wrong password
        if($db_user_password!==$request_user_password){
            return redirect('/')->with(['notify' => true,
                                        'type' => 'danger',
                                        'title' => 'Wrong user account or password!']);
        }

        // Put data into session
        Session::put('login', true);
        Session::put('user_id', $db_user->user_id);
        Session::put('user_first_name', $db_user->user_first_name);
        Session::put('user_last_name', $db_user->user_last_name);
        Session::put('user_email', $db_user->user_email);
        Session::put('user_is_administrator', $db_user->user_is_administrator);
        Session::put('user_is_deputy_hos', $db_user->user_is_deputy_hos);
        Session::put('user_is_casual_academic', $db_user->user_is_casual_academic);
        Session::put('user_is_uos_coordinator', $db_user->user_is_uos_coordinator);

        // Redirect to the home page
        return redirect('/home')->with(['notify' => true,
                                        'type' => 'success',
                                        'title' => 'Log in success!',
                                        'message' => 'Welcome! '.$db_user->user_first_name." ".$db_user->user_last_name.'!']);
    }

    /**
     * Log out
     * URL: GET /exit
     */
    public function exit()
    {
        // Clear the session
        Session::flush();
        // Redirect to the login page
        return redirect('/')->with(['notify' => true,
                                    'type' => 'success',
                                    'title' => 'Log out success!',
                                    'message' => '',]);
    }

}
