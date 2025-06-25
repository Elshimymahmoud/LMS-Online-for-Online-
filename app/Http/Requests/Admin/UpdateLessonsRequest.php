<?php
namespace App\Http\Requests\Admin;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLessonsRequest extends FormRequest
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
        $courseType = Course::findOrFail($this->course_id)->type_id;

        return [
            'course_id' => 'required',
            'chapter_id' => Rule::requiredIf($courseType == 1),
            'title' => 'required',
        ];
    }
}
