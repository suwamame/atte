<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Breaklog;
use App\Http\Controllers\BreakController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthenticatedSessionController;
use Carbon\Carbon;


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

        // 日を跨いだ場合は新しい日のデータを作成
        if ($attendance->start_time && !$attendance->end_time) {
            $tomorrow = now()->addDay()->format('Y-m-d');
            $attendance = Attendance::firstOrNew(['user_id' => $user->id, 'date' => $tomorrow]);
        }

        if (!$attendance->start_time) {
            $attendance->start_time = now();
            $attendance->type = 'start';
            $attendance->save();

            $message = '勤務を開始しました';
            } else {
                $message = '既に勤務が開始されています';
                }
                if (request()->ajax()) {
                    return response()->json(['success' => !$attendance->start_time, 'message' => $message]);
                    } else {
                        // 通常のHTTPリクエストの場合は /stamp にリダイレクト
                        return redirect('/stamp')->with($attendance->start_time ? 'error' : 'success', $message);
                    }


    }

    public function endWorking()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // 今日のデータが存在しなければ新規作成
        $attendance = Attendance::where('user_id', $user->id)
        ->where('date', $today)
        ->first();

        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->date = $today;
        }

        if (!$attendance->end_time) {
            $attendance->end_time = now();
            $attendance->type = 'end';
            $attendance->save();
            $attendance->calculateWorkTime(); // 勤務時間の計算

            $message = '勤務を終了しました';
        } else {
            $message = '既に勤務が終了しています';
        }

        if (request()->ajax()) {
            return response()->json(['success' => !$attendance->end_time, 'message' => $message]);
        } else {
            // 通常のHTTPリクエストの場合は /stamp にリダイレクト
            return redirect('/stamp')->with($attendance->end_time ? 'error' : 'success', $message);
        }
    }

}
