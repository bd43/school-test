<?php

namespace App\Http\Requests\Teacher;
use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;


class UpdateTeacherRequest extends FormRequest
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
        ];
    }

    public function persist()
    {
        $data = $this->prepData($this->all());
        $teacher = Teacher::firstOrCreate(['id' => $this->only('resource_id')]);
        $teacher->classes()->sync($this->classes);
        $teacher->update($data);
       
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
