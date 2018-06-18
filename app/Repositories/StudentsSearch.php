<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class StudentsSearch
{
    public static function apply(Request $filters, $per_page = 'all', $relationships = null)
    {
        $query = (new Student)->newQuery();
        
        // attach relationships to query if param is present
        if($relationships || $filters->has('with_relationships')) {
            $query->with([
                'classes' => function($q) { $q->with('teachers')->remember(1);}, 
                'grades' => function($q) { $q->remember(1);}, 
            ]);
        }

        // Search for student based on id
        if ($filters->filled('id')) {
            return $query->findOrFail($filters->input('id'));
        }

        // Search for students based on firstname
        if ($filters->filled('first_name')) {
            $query = Filters\FirstName::apply($query, $filters->input('first_name'));
        }

        // Search for students based on lastname
        if ($filters->filled('last_name')) {
            $query = Filters\LastName::apply($query, $filters->input('last_name'));
        }

        // Search for students based on year
        if ($filters->has('year')) {
            $query = Filters\Year::apply($query, $filters->input('year'));
        }

        // Search for teachers based on classes
        if ($filters->filled('class_id')) {
            $query = Filters\StudentClass::apply($query, $filters->input('class_id'));
        }

        // Execute the query and paginate the result
        if($per_page == 'all') {
            return $query->get();
        } else {
            return $query->paginate($per_page);    
        }
        
    }

}