<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'credit_hour',
    ];

    public function handbooks()
    {
        return $this->belongsToMany('App\Handbook', 'has_subjects');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'registered_subjects');
    }
}
