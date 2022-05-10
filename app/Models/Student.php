<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable= [
        'first_name',
        'last_name',
        'gender',
        'email',
        'dob',
        'teacher_id',
        'profile_image'
    ];
     public function teacher(){
         return $this->belongsTo(Teacher::class,'teacher_id');
     }
}
