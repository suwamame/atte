<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Breaklog extends Model
{
    use HasFactory;
    protected $table = 'breaks';
    protected $fillable = ['user_id', 'attendance_id', 'type', 'timestamp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
