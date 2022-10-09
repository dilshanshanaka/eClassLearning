<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'mobile',
        'nic',
        'bio',
        'profile_image_path',
        'user_id',
        'isVerified'
    ];
}
