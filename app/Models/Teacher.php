<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable= [
       'first_name',
       'last_name',
        'gender',
        'email',
        'mobile',
        'profile_image'
    ];
    public function students(){
        return $this->hasMany(Student::class,'teacher_id');
    }
}
