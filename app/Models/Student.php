<?php

namespace App\Models;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model 
{
    use Rememberable, SoftDeletes;

    protected $table = 'students';
    public $timestamps = true;
    protected $fillable = ['first_name', 'last_name', 'year'];
    protected $visible = ['id', 'first_name', 'last_name', 'year', 'full_name', 'classes', 'grades_for_classes'];
    protected $appends = ['full_name', 'grades_for_classes'];

    /* RELATIONSHIPS */

    public function classes()
    {
        return $this->belongsToMany('App\Models\StudentClass', 'class_student', 'student_id', 'class_id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grade', 'student_id');
    }


    /* ACCESSORS */

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getGradesForClassesAttribute()
    {
        $classes = $this->classes()->get();
        $grades = $this->grades()->get();

        return $classes->map(function($cls) use ($grades){
            return [$cls->id => $cls->grades->intersect($grades)];
        });
    }

}