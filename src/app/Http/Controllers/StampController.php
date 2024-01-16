<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthenticatedSessionController;


class StampController extends Controller
{
    public function create()
    {
        if (!auth()->check()) {
        return redirect('/login');
    }
        return view('stamp');

        
    }

    public function startWorking()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // 今日のデータが存在しなければ新規作成
        $attendance = Attendance::firstOrNew(['user_id' => $user->id, 'date' => $today]);
        
        $attendance->save();

        if (!$attendance->start_time) {
            $attendance->start_time = now();
            $attendance->type = 'start';
            $attendance->save();
            return response()->json(['success' => true, 'message' => '勤務を開始しました']);
        } else {
            return response()->json(['success' => false, 'message' => '既に勤務が開始されています']);
        }

        // 新しいコード: 勤怠データを取得してビューに渡す
        $attendances = Attendance::where(['user_id' => auth()->user()->id])->get();

        return view('date', ['attendances' => $attendances]);
    }

    public function endWorking()
    {
    $user = Auth::user();
    $today = now()->format('Y-m-d');

    // 新しいレコードを作成
    $newAttendance = new Attendance();
    $newAttendance->user_id = $user->id;
    $newAttendance->date = $today;
    $newAttendance->end_time = now();
    $newAttendance->type = 'end';
    $newAttendance->save();

    return response()->json(['success' => true, 'message' => '勤務を終了しました']);

    
}

}
