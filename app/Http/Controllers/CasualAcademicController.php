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
        $db_casualAcademics = DB::select('SELECT * from user where user_role % 2 = 1 and user_is_available = 1;');
        // 返回列表视图
        return view('/casualAcademic', ['db_casualAcademics' => $db_casualAcademics]);
    }

    public function semesterCreate(){
        // Check login status
        if(!Session::has('login')){
            return loginExpired();  // Have not logged in, redirect to the login page.
        }
        return view('/semesterCreate');
    }

}
