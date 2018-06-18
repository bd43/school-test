<?php

namespace App\Models;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model 
{
    use Rememberable, SoftDeletes;

    protected $table = 'classes';
    protected $fillable = ['teacher_id', 'name', 'year'];
    protected $visible = ['id', 'name', 'year', 'teachers', 'average'];
    protected $appends = ['average'];

    /* RELATIONSHIPS */

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'class_student', 'class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'class_teacher', 'class_id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grade', 'class_id');
    }

    /* ACCESSORS */

    /**
     * Returns average grade for each class, rounded to 2 decimal places
     */
    public function getAverageAttribute()
    {
        return round($this->grades()->avg('value'), 2);
    }

}