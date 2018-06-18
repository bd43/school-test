<?php

namespace App\Models;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model 
{
    use Rememberable, SoftDeletes;

    protected $table = 'grades';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['class_id', 'teacher_id', 'student_id', 'value'];
    protected $visible = ['id', 'class_id', 'teacher_id', 'student_id', 'value'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function class()
    {
        return $this->belongsTo('App\Models\StudentClass');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

}