<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupTestsRequest extends FormRequest
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
            'q.*' => 'exists:questions,id'
        ];
        else
        return [
            'q.*' => 'exists:questions,id'
        ];
        

    }
}
