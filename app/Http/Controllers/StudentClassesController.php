<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Teacher;
use App\Repositories\ClassesSearch;
use App\Http\Requests\StudentClass\CreateClassRequest;
use App\Http\Requests\StudentClass\UpdateClassRequest;

class StudentClassesController extends Controller 
{

  /**
     * Display a listing of all classes.
     *
     * @return Response
     */
    public function index(Request $request)
    {
		$classes = ClassesSearch::apply($request, 15);
		$teachers = Teacher::all();
		return view('classes.list', compact('classes', 'teachers'));
    }

    /**
     * Show the form for creating a new class.
     *
     * @return Response
     */
    public function create()
    {
		$teachers = Teacher::all();
		return view('classes.create', compact('teachers'));
    }

    /**
     * Store a newly created class.
     * @param CreateClassRequest $form 
     * @return Response
     */
    public function store(CreateClassRequest $form)
    {
		$form->persist();
		return redirect()
                ->route('classes.index')
                ->with('alert-success', 'The new class was added.');
    }

    /**
     * Display the specified student profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    	$class = StudentClass::findOrFail($id);
		return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the class.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
		$class = StudentClass::findOrFail($id);
		$teachers = Teacher::all();

		return view('classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified student profile.
     *
     * @param  int  $id
	 * @param UpdateClassRequest $form 
     * @return Response
     */
    public function update(UpdateClassRequest $form, $id)
    {
		$form->persist();
        return redirect()
                ->route('classes.edit', $id)
                ->with('alert-success', 'The class was updated.');
    }

    /**
     * Remove the specified student profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		StudentClass::where('id', $id)->delete();
		return redirect()->back()->with('alert-success', 'The class was deleted.');
    }
  
}

?>