<?php

namespace App\Repositories;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TeachersSearch
{
    public static function apply(Request $filters, $per_page = 'all', $relationships = null)
    {
        $query = (new Teacher)->newQuery();

        // attach relationships to query if param is present
        if($relationships || $filters->has('with_relationships')) {
            $query->with(['grades', 'classes']);
        }
        
        // Search for teachers based on firstname
        if ($filters->filled('first_name')) {
            $query = Filters\FirstName::apply($query, $filters->input('first_name'));
        }

        // Search for teachers based on lastname
        if ($filters->filled('last_name')) {
            $query = Filters\LastName::apply($query, $filters->input('last_name'));
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