<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'matric_no',
        'name',
        'starting_year',
        'course_code',
    ];

    public function course(){
        return $this->belongsTo('App\Course', 'course_code', 'code');
    }

    public function registeredSubjects()
    {
        return $this->belongsToMany('App\Subject', 'registered_subjects');
    }

    public function handbook(){
        return $this->course()->handbooks->where('year', $this->starting_year)->first();
    }
}
