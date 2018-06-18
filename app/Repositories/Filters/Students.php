<?php

namespace App\Repositories\Filters;
use Illuminate\Database\Eloquent\Builder;

class Students implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereHas('students', function($q) use ($value){
            $q->where('student_id', '=', $value);
        });
    }
}