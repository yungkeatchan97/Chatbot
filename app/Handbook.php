<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Handbook extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'year',
        'total_credit_hour',
        'course_code'
    ];

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'has_subjects');
    }

    public function course(){
        return $this->belongsTo('App\Course', 'course_code', 'code');
    }
}
