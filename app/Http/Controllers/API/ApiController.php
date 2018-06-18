<?php

namespace App\Http\Controllers\API;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StudentsSearch;
use App\Repositories\ClassesSearch;
use App\Repositories\TeachersSearch;
use App\Repositories\GradesSearch;



class ApiController extends Controller
{
    /**
     * @param Request $request
     * @return JSON - returns JSON object with filtered `Student` entries
     */

    public function getStudents(Request $request)
    {
        return StudentsSearch::apply($request, 'all', true);
    }

    /**
     * @param Request $request
     * @return JSON - returns JSON object with filtered `StudentClass` entries
     */

    public function getClasses(Request $request)
    {
        return ClassesSearch::apply($request, 'all');
    }

    /**
     * @param Request $request
     * @return JSON - returns JSON object with filtered `Teacher` entries
     */

    public function getTeachers(Request $request)
    {
        return TeachersSearch::apply($request, 'all');
    }

    /**
     * @param Request $request
     * @return JSON - returns JSON object with filtered `Grades` entries
     */

    public function getGrades(Request $request)
    {
        return GradesSearch::apply($request, 'all');
    }


    /**
     * @param Request $request
     * @param int student_id
     * @return JSON - returns a JSON object containing `class_id` and final grade value for each class
     */

    public function getFinalGrade(Request $request)
    {
        if(!$request->has('student_id')) return response()->json(['status' => 0, 'message' => 'The `student_id` parameter is required.']);
        /* Returns Grades Eloquent collection filtered by Request params */
        $grades = $this->getGrades($request);

        /* Group collection by `class_id` parameter and apply `average` method using `value` as a key to obtain final grade */
        return $grades->groupBy('class_id')->map(function($group, $classID){
            return ['final' => round($group->avg('value'), 2)];
        });
    }

    /**
     * @param Request $request
     * @param int class_id
     * @return JSON - returns a JSON object containing `class_id` and average grade value for the corresponding class
     */

    public function getAverageGrade(Request $request)
    {
        if(!$request->has('class_id')) return response()->json(['status' => 0, 'message' => 'The `class_id` parameter is required.']);
        /* Filter `grades` only by `class_id` parameter */
        if($request->has('student_id')) $request->request->remove('student_id');
        /* Returns Grades Eloquent collection filtered by Request params */
        $grades = $this->getGrades($request);

        /* Group collection by `class_id` parameter and apply `average` method using `value` as a key */
        return $grades->groupBy('class_id')->map(function($group, $classID){
            return ['average' => round($group->avg('value'), 2)];
        });
        
    }

}