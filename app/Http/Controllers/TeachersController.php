<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\StudentClass;


use App\Http\Requests\Teacher\CreateTeacherRequest;
use App\Http\Requests\Teacher\UpdateTeacherRequest;
use App\Repositories\TeachersSearch;

class TeachersController extends Controller 
{

  /**
     * Display a listing of all teachers.
     *
     * @return Response
     */
    public function index(Request $request)
    {
		$teachers = TeachersSearch::apply($request, 15);
		$classes = StudentClass::all();
		return view('teachers.list', compact('teachers', 'classes'));
    }

    /**
     * Show the form for creating a new teacher profile.
     *
     * @return Response
     */
    public function create()
    {
		$classes = StudentClass::all()->sortBy('year')->groupBy('year');
		return view('teachers.create', compact('classes'));
    }

    /**
     * Store a newly created teacher.
     * @param CreateTeacherRequest $form 
     * @return Response
     */
    public function store(CreateTeacherRequest $form)
    {
		$form->persist();
		return redirect()
                ->route('teachers.index')
                ->with('alert-success', 'The new teacher profile was added.');
    }

    /**
     * Display the specified teacher profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    	$teacher = Teacher::findOrFail($id);
		return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the teacher profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
		$teacher = Teacher::findOrFail($id);
		$classes = StudentClass::all()->sortBy('year')->groupBy('year');
		return view('teachers.edit', compact('teacher', 'classes'));
    }

    /**
     * Update the specified teacher profile.
     *
     * @param  int  $id
	 * @param UpdateTeacherRequest $form 
     * @return Response
     */
    public function update(UpdateTeacherRequest $form, $id)
    {
		$form->persist();
        return redirect()
                ->route('teachers.edit', $id)
                ->with('alert-success', 'The teacher profile was updated.');
    }

    /**
     * Remove the specified teacher profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		Teacher::where('id', $id)->delete();
		return redirect()->back()->with('alert-success', 'The teacher profile was deleted.');
    }
  
}

?>