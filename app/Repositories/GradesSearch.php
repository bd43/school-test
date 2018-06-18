<?php

namespace App\Repositories;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class GradesSearch
{
    public static function apply(Request $filters, $per_page = 'all', $relationships = null)
    {
        $query = (new Grade)->newQuery();

        // attach relationships to query if param is present
        if($relationships || $filters->has('with_relationships')) {
            $query->with(['students', 'classes', 'teachers']);
        }

        // Search for classes based on year
        if ($filters->filled('student_id')) {
            $query = Filters\Student::apply($query, $filters->input('student_id'));
        }

        // Search for grades based on classes
        if ($filters->filled('class_id')) {
            $query->whereHas('class', function($q) use ($filters){
                if(is_array($filters->input('class_id'))) $q->whereIn('class_id', $filters->input('class_id'));
                else $q->where('class_id', '=', $filters->input('class_id'));
            });
        }

        // Search for classes based on teachers
        if ($filters->filled('teacher_id')) {
            $query = Filters\Teacher::apply($query, $filters->input('teacher_id'));
        }

        // Execute the query and paginate the result
        if($per_page == 'all') {
            return $query->get();
        } else {
            return $query->paginate($per_page);    
        }
        
    }

}