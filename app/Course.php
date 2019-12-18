<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name'
    ];

    public function students()
    {
        return $this->hasMany('App\Student', 'course_code', 'code');
    }

    public function handbooks(){
        return $this->hasMany('App\Handbook', 'course_code', 'code');
    }
}
