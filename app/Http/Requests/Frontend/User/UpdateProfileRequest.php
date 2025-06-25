<?php

namespace App\Http\Requests\Frontend\User;

use Auth;
use Illuminate\Validation\Rule;
use App\Helpers\Frontend\Auth\Socialite;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProfileRequest.
 */
class UpdateProfileRequest extends FormRequest
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
        if(Auth::user()->hasRole('teacher')){
            return [
                'first_name'  => ['required', 'max:191','min:2'],
                'last_name'  => ['required', 'max:191','min:2'],
                'email' => ['sometimes', 'required', 'email', 'max:191'],
                'avatar_type' => ['required', 'max:191', Rule::in(array_merge(['gravatar', 'storage'], (new Socialite)->getAcceptedProviders()))],
                'avatar_location' => ['sometimes', 'image', 'max:191'],
                'gender'              => ['required', 'in:male,female,other'],
                'facebook_link'       => ['nullable', 'url'],
                'twitter_link'        => ['nullable', 'url'],
                'linkedin_link'       => ['nullable', 'url'],
                'payment_method'      => ['required'],
                'bank_name'           => ['required_if:payment_method,bank'],
                'ifsc_code'           => ['required_if:payment_method,bank'],
                'account_number'      => ['required_if:payment_method,bank'],
                'account_name'        => ['required_if:payment_method,bank'],
                'paypal_email'        => ['required_if:payment_method,paypal'],
                'phone'               =>['required'],
            ];
        }{
           
            
            $rules=[
                'first_name'  => ['required', 'max:191','min:2'],
                'last_name'  => ['required', 'max:191','min:2'],
                'email' => ['sometimes', 'required', 'email', 'max:191'],
                'avatar_type' => ['required', 'max:191', Rule::in(array_merge(['gravatar', 'storage'], (new Socialite)->getAcceptedProviders()))],
                'avatar_location' => ['sometimes', 'image', 'max:191'],
                'name_ar'=>['required'],
                'country'=>['required'],
                'national_id_number'=>['required'],
                // 'national_id_number'=>['required',Rule::when($this->country === 'السعوديه',['max:10'])],
                // 'national_id_number'=> Rule::unique('users')->where(function ($query) {
                //     return $query->where('country', 'السعوديه');
                // }),
                'phone'  =>['required'],
                
               
            ];
            if($this->nationality=='سعودي' || $this->nationality=='سعودية'){
                $rules['national_id_number']=['max:10','required'];
            }
            
            return $rules;
        }
    }
}
