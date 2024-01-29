<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function index()
    {

        // 全ユーザーの勤怠情報を取得
        $attendances = Attendance::all();

        $attendances = Attendance::paginate(5);
        
        return view('date', ['attendances' => $attendances]);
        

    
    }


    public function create()
    {
        
    }
}
