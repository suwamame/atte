<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = ['user_id', 'type', 'timestamp', 'date', 'work_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function breaklogs()
    {
        return $this->hasMany(Breaklog::class, 'attendance_id');
    }


    
    
    public function calculateWorkTime()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        
       // $this->breaklogs が null でないことを確認し、メソッドを呼び出す
    if ($this->breaklogs && $this->breaklogs->count() > 0) {
        $breakTime = $this->breaklogs->first()->calculateTotalBreakTime();
    } else {
        $breakTime = 0; // もし breaklogs が null または要素がない場合はゼロとして扱う
    }

        $workTimeInSeconds = $end->diffInSeconds($start) - $breakTime;

        // work_time カラムに計算結果を保存
        $this->work_time = Carbon::now()->setTime(0, 0, $workTimeInSeconds);
        $this->save();

    return $workTimeInSeconds;
    }  


}
