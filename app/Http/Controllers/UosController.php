<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class UosController extends Controller
{
    /**
     * Read Uos info
     * URL: GET /Uos
     */
    public function Uos(Request $request){
         // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        // 获取数据
        $db_uos = DB::table('uos')
                          ->where('uos_is_available', 1)
                          ->orderBy('uos_id', 'asc')
                          ->get();
        // 返回列表视图
        return view('/uos', ['db_uos' => $db_uos]);
    }



}
