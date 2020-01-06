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
        return $this->belongsTo('App\Handbook', 'course_code','course_code')->where('year', '=', $this->starting_year);
    }

    public function creditHour(){
        $hour = 0;
        foreach ($this->registeredSubjects() as $subject){
            $hour += $subject->credit_hour;
        }
        return $hour;
    }
}
