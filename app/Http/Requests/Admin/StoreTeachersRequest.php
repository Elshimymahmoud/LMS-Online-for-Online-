<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeachersRequest extends FormRequest
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
            'first_name' => 'required',
            'name_ar' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:7',
            'gender'              => ['required', 'in:male,female,other'],
            'facebook_link'       => ['nullable', 'url'],
            'twitter_link'        => ['nullable', 'url'],
            'linkedin_link'       => ['nullable', 'url'],
            'payment_method'      => ['nullable'],
            'bank_name'           => ['nullable'],
            'ifsc_code'           => ['nullable'],
            'account_number'      => ['nullable'],
            'account_name'        => ['nullable'],
            'paypal_email'        => ['nullable'],
            'roles'               =>['required'],
            'phone'               =>['nullable']

            // 'image'               => ['required', 'mimes:jpeg,png,jpg'],

        ];
    }
  

}
