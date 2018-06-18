<?php

namespace App\Repositories;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ClassesSearch
{
    public static function apply(Request $filters, $per_page = 'all', $relationships = null)
    {
        $query = (new StudentClass)->newQuery();

        // Attach relationships to query if param is present
        if($relationships || $filters->has('with_relationships')) {
            $query->with(['students', 'grades', 'teachers']);
        }

        // Search for classes based on name
        if ($filters->filled('name')) {
            $query = Filters\Name::apply($query, $filters->input('name'));
        }

        // Search for classes based on year
        if ($filters->filled('year')) {
            $query = Filters\Year::apply($query, $filters->input('year'));
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