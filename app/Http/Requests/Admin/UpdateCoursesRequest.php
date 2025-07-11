<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoursesRequest extends FormRequest
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
            
            'teachers.*' => 'exists:users,id',
            'title' => 'required',
            // 'start_date' => 'nullable|date_format:'.config('app.date_format'),
            // 'end_date' => 'nullable|date_format:'.config('app.date_format'),
            'slug'=>'unique:courses,slug,'.$this->course,
        ];
    }
}
