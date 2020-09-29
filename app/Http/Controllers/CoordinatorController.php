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
     * Read coordinator info
     * URL: GET /coordinator
     */
    public function Coordinator(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $db_coordinator = DB::select('SELECT * from user where user_is_uos_coordinator = 1 and user_is_available = 1;');
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

}
