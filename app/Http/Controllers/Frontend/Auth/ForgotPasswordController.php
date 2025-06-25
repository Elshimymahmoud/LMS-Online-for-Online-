<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $email=request('email');
        if($email){
            $exist=User::where('email',$email)->first();
        }
        if(($email&&$exist)||!$email)
        return view('frontend.auth.passwords.email-new');
        else
        return view('frontend.auth.passwords.email-new')->withErrors(['error'=> __('auth.not_exist')]);

    }
}
