<?php

namespace App\Http\Requests\Grade;
use App\Models\Grade;
use Illuminate\Foundation\Http\FormRequest;


class UpdateGradeRequest extends FormRequest
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
            'class_id'          =>  'required|numeric',
            'teacher_id'        =>  'required|numeric',
            'student_id'        =>  'required|numeric',
            'value'             =>  'required|numeric|between:1,10'
        ];
    }

    public function persist()
    {
        $data = $this->prepData($this->all());
        $grade = Grade::firstOrCreate(['id' => $this->only('resource_id')]);
        // update student entry
        $grade->update($data);
       
        return $grade;
    }

    private function prepData($formData)
    {
        return [
            'class_id'       =>  $formData['class_id'],
            'student_id'     =>  $formData['student_id'],
            'teacher_id'     =>  $formData['teacher_id'],
            'value'          =>  $formData['value']
        ];
    }
    
}
