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

}
