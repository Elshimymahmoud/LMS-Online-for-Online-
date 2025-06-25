<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoriesRequest extends FormRequest
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
            'title' => 'required',
            'title_ar' => 'required',
            'description' => 'required',
            'description_ar' => 'required',
            'course1' => 'required',
            'course1_ar' => 'required',
            'date1' => 'required',
            'students1' => 'required',
            'training_days1' => 'required',
            'course2' => 'required',
            'course2_ar' => 'required',
            'date2' => 'required',
            'students2' => 'required',
            'training_days2' => 'required',
        ];
    }
}
