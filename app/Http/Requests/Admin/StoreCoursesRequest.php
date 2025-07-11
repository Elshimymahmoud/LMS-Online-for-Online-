<?php
namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCoursesRequest extends FormRequest
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
       
        if($this->slug==null)
        return [
            'teachers.*' => 'exists:users,id',
            'title' => 'required',
            'category_id' => 'required',
            'type_id' => 'required'
            
        ];
        else{
            return [
                'teachers.*' => 'exists:users,id',
                'title' => 'required',
                'category_id' => 'required',
                // 'start_date' => 'date_format:'.config('app.date_format'),
                'slug'=>'unique:courses'  ,
                'type_id' => 'required'
            

            ];
        }
    }
}
