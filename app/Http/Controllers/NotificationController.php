<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;


class NotificationController extends Controller
{

    public function index()
    {
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        $db_notifications = DB::table('notification')
                          ->orderBy('notification_id', 'asc')
                          ->get();


    }

    public function read(Request $request)
    {

        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        $notification_id= $request->input('notification_id');
        DB::beginTransaction();
        try{
            DB::table('notification')
                ->where('notification_id',$notification_id)
                ->update(['notification_is_read'=> 1]);
            }
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
            return redirect("/inbox");
    }

    public function allread()
    {

        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        $db_notifications = DB::table('notification')
                          ->orderBy('notification_id', 'asc')
                          ->get();

        DB::beginTransaction();
        try{
            foreach ($db_notifications as $db_notification)
                {
                    DB::table('notification')
                        ->where('notification_id',0)
                        ->update(['notification_is_read'=> 1]);
                }
            }

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
            return redirect("/inbox");
    }

    public function star(Request $request)
    {

        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        $notification_id= $request->input('notification_id');
        DB::beginTransaction();
        try{
            DB::table('notification')
                ->where('notification_id',$notification_id)
                ->update(['notification_is_read'=> 2]);
            }
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
            return redirect("/inbox");
    }


    public function unstar(Request $request)
    {

        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        $notification_id= $request->input('notification_id');
        DB::beginTransaction();
        try{
            DB::table('notification')
                ->where('notification_id',$notification_id)
                ->update(['notification_is_read'=> 1]);
            }
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
            return redirect("/inbox");
    }


    public function inbox()
    {
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }

        $db_notifications = DB::table('notification')
                          ->orderBy('notification_id', 'asc')
                          ->get();



        return view('/inbox', ['db_notifications' => $db_notifications]);


    }

}
