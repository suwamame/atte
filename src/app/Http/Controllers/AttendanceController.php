<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function showDate($date)
    {
        $user = Auth::user();
        // $date には表示したい日付が渡されると仮定
        $attendances = Attendance::where(['user_id' => $user->id, 'date' => $date])->get();

        return view('date', ['attendances' => $attendances, 'date' => $date]);
    }
}
