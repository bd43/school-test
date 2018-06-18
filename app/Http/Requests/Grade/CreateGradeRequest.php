<?php

namespace App\Http\Requests\Grade;
use App\Models\Grade;
use Illuminate\Foundation\Http\FormRequest;

class CreateGradeRequest extends FormRequest
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
        $grade = Grade::firstOrCreate($data);
        $grade->save();
       
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


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $nubmerOfGradesForStudent = Grade::where('student_id', '=', $this->student_id)->where('class_id', '=', $this->class_id)->where('teacher_id', '=', $this->teacher_id)->count();
            if ($nubmerOfGradesForStudent > 2) {
                $validator->errors()->add('value', 'The student has the maximum number of grades in the selected class.');
            }
        });
    }
    
}
