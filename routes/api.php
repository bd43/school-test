<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('throttle:1000,1')->group(function(){
    /**
     *  Get `Students` collection in JSON format 
     */
    Route::get('students', 'API\ApiController@getStudents');

    /** 
     * Get `Teachers` collection in JSON format 
     */
    Route::get('teachers', 'API\ApiController@getTeachers');

    /** 
     * Get `Classes` collection in JSON format 
     */
    Route::get('classes', 'API\ApiController@getClasses');

    /** 
     * Get `Grades` collection in JSON format 
     */
    Route::get('grades', 'API\ApiController@getGrades');

    /**
     *  Calculates final grade for a student in one or more classes
     *  If only the `student_id` parameter is supplied, it will 
     *  return the final grade for each class in which the student
     *  is enrolled.
     */
    Route::get('final-grade', 'API\ApiCOntroller@getFinalGrade');

    /* Average grade for one or more classes */
    Route::get('average-grade', 'API\ApiCOntroller@getAverageGrade');
});