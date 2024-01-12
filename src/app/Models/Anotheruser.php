<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Anotheruser extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }
}
