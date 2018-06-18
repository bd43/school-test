<?php

namespace App\Http\Requests\StudentClass;
use App\Models\StudentClass;
use Illuminate\Foundation\Http\FormRequest;


class UpdateClassRequest extends FormRequest
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
            'teacher_id'    =>  'required|numeric', 
            'name'          =>  'required|alpha_spaces_punctuation',
            'year'          =>  'required|numeric|in:1,2,3',
        ];
    }

    public function persist()
    {
        $data = $this->prepData($this->all());
        $class = StudentClass::firstOrCreate(['id' => $this->only('resource_id')]);
        $class->teachers()->sync($this->teacher_id);
        $class->update($data);
       
        return $class;
    }

    private function prepData($formData)
    {
        return [
            'name'          =>  $formData['name'],
            'year'          =>  $formData['year']
        ];
    }
    
}
