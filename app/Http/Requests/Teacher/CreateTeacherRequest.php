<?php

namespace App\Http\Requests\Teacher;
use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;


class CreateTeacherRequest extends FormRequest
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
            'classes'           =>  'required|min:1'
        ];
    }

    public function persist()
    {
        $data = $this->prepData($this->all());
        $teacher = Teacher::firstOrCreate($data);

        $teacher->classes()->sync($this->classes);

        $teacher->save();

        return $teacher;
    }

    private function prepData($formData)
    {
        return [
            'first_name'    =>  $formData['first_name'],
            'last_name'     =>  $formData['last_name'],
        ];
    }
    
}
