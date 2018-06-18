<?php

namespace App\Models;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model 
{
    use Rememberable, SoftDeletes;
    
    protected $table = 'teachers';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = ['first_name', 'last_name'];
    protected $visible = ['id', 'first_name', 'last_name', 'full_name'];
    protected $appends = ['full_name'];

    /* RELATIONSHIPS */

    public function classes()
    {
        return $this->belongsToMany('App\Models\StudentClass', 'class_teacher', 'teacher_id', 'class_id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grades');
    }
    

    /* ACCESSORS */

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

}