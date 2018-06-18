<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClass;

use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Repositories\StudentsSearch;

class StudentsController extends Controller 
{

    /**
     * Display a listing of all students.
     *
     * @return Response
     */
    public function index(Request $request)
    {
		$students = StudentsSearch::apply($request, 15);
		$classes = StudentClass::all();
		return view('students.list', compact('students', 'classes'));
    }

    /**
     * Show the form for creating a new student profile.
     *
     * @return Response
     */
    public function create()
    {
		$classes = StudentClass::get()->groupBy('year');
		return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created student profile.
     * @param CreateStudentRequest $form 
     * @return Response
     */
    public function store(CreateStudentRequest $form)
    {
		$form->persist();
		return redirect()
                ->route('students.index')
                ->with('alert-success', 'The new student profile was added.');
    }

    /**
     * Display the specified student profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    	$student = Student::findOrFail($id);
		return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the student profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
		$student = Student::findOrFail($id);
		$classes = StudentClass::all()->groupBy('year');
		return view('students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified student profile.
     *
     * @param  int  $id
	 * @param UpdateStudentRequest $form 
     * @return Response
     */
    public function update(UpdateStudentRequest $form, $id)
    {
		$form->persist();
        return redirect()
                ->route('students.edit', $id)
                ->with('alert-success', 'The student profile was updated.');
    }

    /**
     * Remove the specified student profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		Student::where('id', $id)->delete();
		return redirect()->back()->with('alert-success', 'The student profile was deleted.');
    }
  
}

?>