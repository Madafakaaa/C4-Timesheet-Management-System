<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TutorialController extends Controller
{
    /**
     * Read Tutorial info
     * URL: GET /Tutorial
     */
    public function Tutorial(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $tutorial_uos=$request->input('tutorial_uos');
        $db_tutorial = DB::table('tutorial')->where('tutorial_uos', $tutorial_uos)->get();
        // 返回列表视图
        return view('/tutorial', ['db_tutorial' => $db_tutorial]);
    }

    public function TutorialAssign(Request $request){

    }


}
