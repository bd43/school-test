<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model 
{

    protected $table = 'class_student';
    public $timestamps = false;
    protected $fillable = array('class_id', 'student_id');
    protected $visible = array('class_id', 'student_id');

}