<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Breaklog extends Model
{
    use HasFactory;
    protected $table = 'breaks';
    protected $fillable = ['user_id', 'attendance_id', 'type', 'timestamp', 'break_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function calculateTotalBreakTime()
    {
        $breakLogs = $this->attendance->breaklogs()->get();

        $totalBreakTimeInSeconds = 0;
        $startTimestamp = null;

        foreach ($breakLogs as $breakLog) {
            if ($breakLog->type == 'start') {
                $startTimestamp = $breakLog->timestamp;
            } elseif ($breakLog->type == 'end' && $startTimestamp !== null) {
                $endTimestamp = $breakLog->timestamp;
                $totalBreakTimeInSeconds += \Carbon\Carbon::parse($startTimestamp)->diffInSeconds($endTimestamp);
                $startTimestamp = null; 
            }
        }

         return $totalBreakTimeInSeconds;
    }
    

    
}
