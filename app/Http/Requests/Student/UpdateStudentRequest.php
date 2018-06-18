<?php

namespace App\Http\Requests\Student;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;


class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'        =>  'required|alpha_spaces_punctuation',
            'last_name'         =>  'required|alpha_spaces_punctuation',
            'year'              =>  'required|numeric|in:1,2,3',
            'classes'           =>  'required|min:1'
        ];
    }

    public function persist()
    {
        $data = $this->prepData($this->all());
        $student = Student::firstOrCreate(['id' => $this->only('resource_id')]);
        // sync classes
        $student->classes()->sync($this->classes);
        // update student entry
        $student->update($data);
       
        return $student;
    }

    private function prepData($formData)
    {
        return [
            'first_name'    =>  $formData['first_name'],
            'last_name'     =>  $formData['last_name'],
            'year'          =>  $formData['year']
        ];
    }
    
}
