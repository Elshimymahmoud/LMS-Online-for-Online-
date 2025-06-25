<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Http\Request;


/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $token
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function confirm($token)
    {
        $this->user->confirm($token);

        return redirect()->route('frontend.auth.login')->withFlashSuccess(__('exceptions.frontend.auth.confirmation.success'));
    }

    /**
     * Get activate view
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function activate($uuid){
        $user = User::where('uuid', $uuid)->first();
        return view('frontend.auth.activate', compact('user'));
    }

    /**
     * Activate account
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function activateAccount(Request $request, $uuid){

        $user = User::where('uuid', $uuid)->first();

        if ($user->is_activate == 1 && $user->confirmed == 1){
            return redirect()->route('frontend.auth.login')->withFlashSuccess(__('alerts.backend.users.already_confirmed'));
        }

        $code = $request->activation_code;

        if ($code == $user->activation_code) {
            $user->is_activate = 1;
            $user->confirmed = 1;
            $user->activation_code = null;
            $user->save();

            // Make sure the user is logged in
            auth()->login($user);

            // Return to last visited course
            if (session()->has('previous_course_page')) {
                return redirect(session()->get('previous_course_page'));
            }

            return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.confirmed'));
        } else {
            return redirect()->back()->withFlashSuccess(__('alerts.backend.users.unconfirmed'));
        }
    }

    /**
     * @param $uuid
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function sendConfirmationEmail($uuid)
    {
        $user = $this->user->findByUuid($uuid);

        if ($user->isConfirmed()) {
            return redirect()->route('frontend.auth.login')->withFlashSuccess(__('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->route('frontend.auth.login')->withFlashSuccess(__('exceptions.frontend.auth.confirmation.resent'));
    }
}
