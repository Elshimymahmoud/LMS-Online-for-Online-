<?php

use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ConfirmAccountController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordExpiredController;
use App\Http\Controllers\Frontend\Auth\TeacherRegisterController;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */
Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {

    /*
    * These routes require the user to be logged in
    */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('logout2', [LoginController::class, 'logout2'])->name('logout2');



        //For when admin is logged in as user from backend
        Route::get('logout-as', [LoginController::class, 'logoutAs'])->name('logout-as');

        // These routes can not be hit if the password is expired
        Route::group(['middleware' => 'password_expires'], function () {
            // Change Password Routes
            Route::patch('password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
        });

        // Password expired routes
        if (is_numeric(config('access.users.password_expires_days'))) {
            Route::get('password/expired', [PasswordExpiredController::class, 'expired'])->name('password.expired');
            Route::patch('password/expired', [PasswordExpiredController::class, 'update'])->name('password.expired.update');
        }
        Route::get('change-passwordd', 'Auth\ChangePasswordController@showChangePasswordForm')->name('login.change_password');

        Route::get('change-password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('change_password');
       Route::patch('change-password', 'Auth\ChangePasswordController@changePassword')->name('change_password');
      
       // ======= Banners Routtes=====//
    });

    /*
     * These routes require no user to be logged in
     */
    // Password Reset Routes
    Route::get('password/reset2', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.post');

    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
        Route::get('login/otp', [LoginController::class, 'otpForm'])->name('password.otp.form');
        Route::post('login/otp/send', [LoginController::class, 'otpSend'])->name('password.otp.sendOtp');
        Route::post('login/otp/verify', [LoginController::class, 'otpVerify'])->name('password.otp.verifyOtp');

        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'login']);

        // Registration Routes
        if (config('access.registration')) {
            Route::get('register', [LoginController::class, 'showRegisterForm'])->name('register');
            Route::post('register', [RegisterController::class, 'register'])->name('register.post');
        }

        // Confirm Account Routes
        Route::get('account/confirm/{token}', [ConfirmAccountController::class, 'confirm'])->name('account.confirm');
        Route::get('account/confirm/resend/{uuid}', [ConfirmAccountController::class, 'sendConfirmationEmail'])->name('account.confirm.resend');
        Route::get('account/activate/{uuid}', [ConfirmAccountController::class, 'activate'])->name('account.activate','uuid');
        Route::post('account/activate/confirm/{uuid}', [ConfirmAccountController::class, 'activateAccount'])->name('account.activate.conform');

        
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');


        // New Register Teacher Routes
        Route::get('teacher/register',[TeacherRegisterController::class, 'showTeacherRegistrationForm'])->name('teacher.register');
        Route::post('teacher/register', [TeacherRegisterController::class, 'register'])->name('teacher.register.post');

    });
});
