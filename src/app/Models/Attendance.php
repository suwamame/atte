<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = ['user_id', 'type', 'timestamp', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }


}
