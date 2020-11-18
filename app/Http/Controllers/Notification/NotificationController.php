<?php
namespace App\Http\Controllers\Notification;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class NotificationController extends Controller
{

    /**
     * notification
     * URL: GET /notification
     */
    public function notification(){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $user_id = Session::get('user_id');

        // get all notifications
        $db_all_notifications = DB::table('notification')
                              ->join('user', 'notification.notification_create_user', '=', 'user.user_id')
                              ->where('notification_user', $user_id)
                              ->orderBy('notification_is_read', 'asc')
                              ->orderBy('notification_id', 'desc')
                              ->get();
        // get unread notifications
        $db_unread_notifications = DB::table('notification')
                              ->join('user', 'notification.notification_create_user', '=', 'user.user_id')
                              ->where('notification_is_read', 0)
                              ->where('notification_user', $user_id)
                              ->orderBy('notification_id', 'desc')
                              ->get();
        // get read notifications
        $db_read_notifications = DB::table('notification')
                              ->join('user', 'notification.notification_create_user', '=', 'user.user_id')
                              ->where('notification_is_read', 1)
                              ->where('notification_user', $user_id)
                              ->orderBy('notification_id', 'desc')
                              ->get();

        // Update notifications status
       // DB::table('notification')
          //->where('notification_user', $user_id)
          //->update(['notification_is_read' => 1]);
        // return view
       return view('/notification/notification', ['db_all_notifications' => $db_all_notifications,
                                                  'db_unread_notifications' => $db_unread_notifications,
                                                  'db_read_notifications' => $db_read_notifications]);
    }

    public function notificationMark(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $notification_id = $request->input('id');
        // Update notifications status
        DB::table('notification')
          ->where('notification_id', $notification_id)
          ->update(['notification_is_read' => 1]);
        // Redirect to the semester page
        return back()->with(['notify' => true,
                            'type' => 'success',
                            'title' => 'Success!',
                            'message' => 'Success!']);
    }

    public function notificationMarkAll(){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $user_id = Session::get('user_id');
        // Update notifications status
        DB::table('notification')
          ->where('notification_user', $user_id)
          ->update(['notification_is_read' => 1]);
        // Redirect to the semester page
        return back()->with(['notify' => true,
                            'type' => 'success',
                            'title' => 'Success!',
                            'message' => 'Success!']);
    }

}
