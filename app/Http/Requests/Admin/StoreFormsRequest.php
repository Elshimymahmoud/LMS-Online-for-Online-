<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormsRequest extends FormRequest
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
    public  function rules()
    {
        if($this->slug==null)
        return [
            'questions.*' => 'exists:questions,id',
            'chapter_id'=>'required'
        ];
        else
        return [
            'questions.*' => 'exists:questions,id',
            'slug'=>'unique:tests',
            'chapter_id'=>'required'
        ];
        

    }
}
