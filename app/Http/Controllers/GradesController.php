<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\StudentClass;
use App\Models\Grade;
use App\Models\Student;
use App\Repositories\GradesSearch;

use App\Http\Requests\Grade\CreateGradeRequest;
use App\Http\Requests\Grade\UpdateGradeRequest;

class GradesController extends Controller 
{

  /**
     * Display a listing of all teachers.
     *
     * @return Response
     */
    public function index(Request $request)
    {
		$grades = GradesSearch::apply($request, 15);
		$classes = StudentClass::all();
		$teachers = Teacher::all();
		$students = Student::all();
		return view('grades.list', compact('grades', 'classes', 'teachers', 'students'));
    }

    /**
     * Show the form for creating a new grade.
     *
     * @return Response
     */
    public function create()
    {
		return view('grades.create');
    }

    /**
     * Store a newly created grade.
     * @param CreateGradeRequest $form 
     * @return Response
     */
    public function store(CreateGradeRequest $form)
    {
		$form->persist();
		return redirect()
                ->route('grades.index')
                ->with('alert-success', 'A new grade was added.');
    }

    /**
     * Display the specified grade.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
		
    }

    /**
     * Show the form for editing the grade.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
		$grade = Grade::findOrFail($id);
		return view('grades.edit', compact('grade'));
    }

    /**
     * Update the specified grade.
     *
     * @param  int  $id
	 * @param UpdateGradeRequest $form 
     * @return Response
     */
    public function update(UpdateGradeRequest $form, $id)
    {
		$form->persist();
        return redirect()
                ->route('grades.edit', $id)
                ->with('alert-success', 'The grade was updated.');
    }

    /**
     * Remove the specified grade.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		Grade::where('id', $id)->delete();
		return redirect()->back()->with('alert-success', 'The grade was deleted.');
    }
  
}

?>