<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
use App\Helpers\Auth\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\FatoorahServices;
use App\Http\Controllers\Services\SmsServices;
use App\Models\Auth\User;
use App\Models\CartItem;
use App\Models\Course;
use App\Repositories\Frontend\Auth\UserSessionRepository;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Carbon\Carbon;
use Cart;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use TaqnyatSms;


/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var SmsService
     */
    private $smsService;

    public function __construct(SmsServices $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {

        return view('frontend.login');

        // if(request()->ajax()){
        //     return ['socialLinks' => (new Socialite)->getSocialLinks()];
        // }

        // return redirect('/')->with('show_login', true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterForm()
    {

        return view('frontend.register');

        // if(request()->ajax()){
        //     return ['socialLinks' => (new Socialite)->getSocialLinks()];
        // }

        // return redirect('/')->with('show_login', true);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    public function emailPhone()
    {
        return config('access.users.email_phone');
    }

    function validate_mobile($mobile)
    {
        return preg_match('/^[0-9]+$/', $mobile);
    }

    public function login(Request $request)
    {

        if (Session::token() != Input::get('_token')) {


            \Illuminate\Support\Facades\Auth::logout();

            return redirect()->back()->withErrors(['error' => 'Login failed.plz try again']);
        }
        $validator = Validator::make(Input::all(), [// 'email' => 'required|email|max:255',
            'email_phone' => 'required|max:255',

            'password' => 'required|min:6', 'g-recaptcha-response' => (config('access.captcha.registration') ? ['required', new CaptchaRule] : ''),], ['g-recaptcha-response.required' => __('validation.attributes.frontend.captcha'),]);

        if ($validator->passes()) {
            if (filter_var($request->email_phone, FILTER_VALIDATE_EMAIL)) {
                $credentials = ['email' => $request->email_phone, 'password' => $request->password];
            } elseif ($this->validate_mobile($request->email_phone)) {
                $credentials = ['phone' => $request->email_phone, 'password' => $request->password];
            } else {
                $credentials = ['email' => $request->email_phone, 'password' => $request->password];
            }
            $authSuccess = \Illuminate\Support\Facades\Auth::attempt($credentials, $request->has('remember'));

            $courseSlug = $request->course_slug;

            if ($authSuccess) {
                $request->session()->regenerate();


                // Check if the user is confirmed
                if (!auth()->user()->confirmed) {
                    \Illuminate\Support\Facades\Auth::logout();
                    return redirect()->back()->withErrors(['error' => __('alerts.backend.users.unconfirmed')]);
                }

                // Check if the user is active
                if (!auth()->user()->active) {
                    \Illuminate\Support\Facades\Auth::logout();
                    return redirect()->back()->withErrors(['error' => __('alerts.backend.users.not_active')]);
                }

                if (auth()->user()->active > 0) {

                    $user = auth()->user();
                    // Check if there are items in the guest's cart session
                    $guestCartItems = Cart::session('guest')->getContent();

                    if ($guestCartItems->isNotEmpty()) {
                        foreach ($guestCartItems as $item) {
                            // Add each item to the authenticated user's cart session
                            Cart::session($user->id)->add($item->id, $item->name, $item->price, $item->quantity, $item->attributes);
                            CartItem::create(['user_id' => $user->id, 'course_id' => $item->id, 'group_id' => $item->attributes->course_group_id, 'quantity' => 1]);

                            // Optionally, remove the item from the guest's cart session
                            Cart::session('guest')->remove($item->id);
                        }
                    }
                    $date = Carbon::now();

                    $user->update(['last_login_at' => $date]);
                    if (auth()->user()->isAdmin()) {
                        // $redirect = 'dashboard';
                        $redirect = 'admin';
                    } else {
                        // $redirect = 'back';

                        $redirect = 'admin';
                    }
                    if (session()->has('previous_course_page')) {
                        return redirect(session()->get('previous_course_page'));
                    }
                    if ($courseSlug) {
                        $course = Course::where('slug', $courseSlug)->first();

                        $courseLocation = $course->locations->where('pivot.id', $request->course_location_id)->first();
                        if ($courseLocation) {
                            $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;
                            if ($purchased_course) {
                                return redirect()->route('courses.details', ['course' => $courseSlug, 'course_location_id' => $request->course_location_id]);
                            } else {
                                $request = new Request();
                                $request['course_id'] = $course->id;
                                $request['course_location_id'] = $courseLocation->pivot->id;
                                $request['currency'] = $courseLocation->pivot->currency;
                                $request['amount'] = $courseLocation->pivot->price;

                                $newCartObj = new CartController(new FatoorahServices(new Client()));
                                $view = $newCartObj->checkout($request);
                                $data = $view->getData();
                                return view($view->getName())->with($data);
                            }
                        }
                        return redirect()->route('courses.show', ['course' => $courseSlug]);
                    } else {
                        return redirect($redirect);
                    }


                    // return response(['success' => true,'redirect' => $redirect], Response::HTTP_OK);
                } else {

                    \Illuminate\Support\Facades\Auth::logout();

                    // return
                    //     response([
                    //         'success' => false,
                    //         'message' => 'Login failed. Account is not active'
                    //     ], Response::HTTP_FORBIDDEN);
                    return redirect()->back()->withErrors(['error' => 'Login failed. Account is not active']);
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Login failed. Account not found']);

            }


        }

        return redirect()->back()->withErrors(['error' => 'Login failed. Account or password is not correct']);

        return response(['success' => false, 'errors' => $validator->errors()]);
    }


    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {
        /*
         * Check to see if the users account is confirmed and active
         */
        if (!$user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail

            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', $user->{$user->getUuidName()})]));
        } elseif (!$user->isActive()) {
            auth()->logout();
            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        // If only allowed one session at a time
        if (config('access.users.single_login')) {
            resolve(UserSessionRepository::class)->clearSessionExceptCurrent($user);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }

    public function logout2(Request $request)
    {
        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.auth.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (!auth()->user()) {
            return redirect()->route('frontend.auth.login');
        }

        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            // Re-login admin
            auth()->loginUsingId((int)$admin_id);

            // Redirect to backend user page
            return redirect()->route('admin.auth.user.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            // Otherwise logout and redirect to login
            auth()->logout();

            return redirect()->route('frontend.auth.login');
        }
    }

    public function otpForm(){

        return view('frontend.auth.otp');
    }

    public function otpSend(Request $request){

        // Find the user by phone
        if ($request->mobile != null) {
           $phone = $this->normalizePhoneNumber($request->mobile);
           $user = User::where('phone', $phone)->first();
           if (!$user) {
               return response()->json(['error' => __('labels.frontend.auth.invalid_number')]);
           }
        } else {
            return response()->json(['error' => __('labels.frontend.auth.invalid_number')]);
        }

        // Add user to the session
        session(['otp_attempt_user' => $user->id]);

        // Generate a new OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        // Send the OTP to the user phone
        try {
            // Get Sms token
            $token = config('taqnyat.token');
            $taqnyat = new TaqnyatSms($token);

            // Prepare the message
            $body = __('labels.frontend.auth.otp_body'). ' ' . $otp;

            // Remove 00 or + from the start of the phone number
            $phone = $this->normalizePhoneNumber($user->phone);

            $recipients = [
                $phone
            ];
            $sender = 'IvoryTR';

            // Send the message
            $taqnyat->sendMsg($body, $recipients, $sender);

        } catch (\Exception $e) {
            return response()->json(['error' => __('labels.frontend.auth.err_sending_otp')]);
        }

        return response()->json(['success' => true]);
    }

    public function otpVerify(Request $request) {

        // check if otp_attempt_user is set
        if (!session()->has('otp_attempt_user')) {
            return response()->json(['error' => __('labels.frontend.auth.err_happened_please_retry')]);
        }

        $user = User::findOrFail(session('otp_attempt_user'));

        if ($user->otp == $request->otp) {
            auth()->login($user);
            session()->forget('otp_attempt_user');
            $user->otp = null;
            $user->save();

            // Redirect user to the admin site
            $redirect = 'admin';

            // Redirect user to the last visited site
            if (session()->has('previous_course_page')) {
                $redirect = session()->get('previous_course_page');
            }

            return response()->json(['success' => true, 'redirect' => $redirect]);
        }

        return response()->json(['error' => __('labels.frontend.auth.invalid_otp')]);
    }

    private function normalizePhoneNumber($phone) {
        // Remove any non-numeric characters except the leading '+'
        $phone = preg_replace('/(?!^\+)\D/', '', $phone);

        // Remove leading '00' or '0' if present
        if (substr($phone, 0, 2) === '00') {
            $phone = substr($phone, 2);
        } elseif (substr($phone, 0, 1) === '0') {
            $phone = substr($phone, 1);
        }

        // Remove leading '+' if present
        if (substr($phone, 0, 1) === '+') {
            $phone = substr($phone, 1);
        }

        return $phone;
    }
}
