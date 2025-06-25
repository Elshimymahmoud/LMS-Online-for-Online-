<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Services\SmsServices;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Mail\ActivateAccount;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Helpers\Frontend\Auth\Socialite;
use Illuminate\Support\Facades\Validator;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Services\FatoorahServices;
use App\Mail\courseEmail;
use App\Models\Course;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ClosureValidationRule;
use App\Repositories\Frontend\Auth\UserRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use TaqnyatSms;


/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var SmsService
     */
    private $smsService;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, SmsServices $smsService)
    {
        $this->userRepository = $userRepository;
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        abort_unless(config('access.registration'), 404);

        return view('frontend.auth.register')
            ->withSocialiteLinks((new Socialite)->getSocialLinks());
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function register(Request $request)
    {
        // return $request;
        $validator = Validator::make(Input::all(), [
            'name_ar' => 'required|max:191|min:2',
            'fourth_name_ar' => 'required|max:191|min:2',

            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => (config('access.captcha.registration') ? ['required', new CaptchaRule] : ''),
            'national_id_number' => 'nullable',
            'phoneNumber' => 'required|unique:users,phone',
            'allow_personal_info' => 'nullable|boolean',

        ], [
            'g-recaptcha-response.required' => __('validation.attributes.frontend.captcha'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($validator->passes()) {

            // Store your user in database
            $user = $this->create($request->all());
            event(new Registered($user));


            return redirect()->route('frontend.auth.account.activate', ['uuid' => $user->uuid])->withFlashSuccess(__('alerts.frontend.backend.user.confirmation_email'));

        }
       
        return redirect()->back();

    }
    public function generateQrCode($user){
        Storage::disk('QrLogin')->put("qrCodesLogin/" . $user->id.'_'.$user->uuid . '.svg', DNS2D::getBarcodeSVG(route('frontend.auth.login').'?email='.$user->email, 'QRCODE'));

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        $user = User::create([
            // 'first_name' => $data['first_name'],
            // 'last_name' => $data['last_name'],
            // 'third_name' => $data['third_name'],
            // 'fourth_name' => $data['fourth_name'],

            'email' => $data['email'],
            // 'national_id_number' => $data['national_id_number'],
            'name_ar' => $data['name_ar'],
            // 'sec_name_ar' => $data['sec_name_ar'],
            // 'third_name_ar' => $data['third_name_ar'],
            'fourth_name_ar' => $data['fourth_name_ar'],



            'password' => Hash::make($data['password']),
        ]);

        $user->dob = isset($data['dob']) ? $data['dob'] : NULL;
        $user->phone = isset($data['phoneNumber']) ? $data['phoneNumber'] : NULL;
        $user->gender = isset($data['gender']) ? $data['gender'] : NULL;
        $user->address = isset($data['address']) ? $data['address'] : NULL;
        $user->city =  isset($data['city']) ? $data['city'] : NULL;
        $user->pincode = isset($data['pincode']) ? $data['pincode'] : NULL;
        $user->state = isset($data['state']) ? $data['state'] : NULL;
        $user->country = isset($data['country']) ? $data['country'] : NULL;
        $user->save();

        $userForRole = User::find($user->id);
        $userForRole->confirmed = 0;
        $userForRole->save();
        $userForRole->assignRole('student');
        // ////

        $this->sendEmailActivate($user->id);
        // ///
        $content = [];
        $content['course_name'] = null;
        $content['course_slug'] = null;
        $content['email'] = $data['email'];
        $content['password'] = $data['password'];
        $content['student'] = $user;

        // dispatch(new SendEmailJob($request->email,$content));
        try {
            \Mail::to($user->email)->send(new courseEmail($content));
        } catch (\Throwable $th) {
            //throw $th;
        }

        // ///

//        auth()->login($user);
        $this->generateQrCode($user);


        return $user;
        // return redirect()->route('admin.auth.user.index');

    }

    public function sendEmailActivate($id, $logged = "false")
    {
        // /////////////

        $user = User::findOrFail($id);
        $code = $this->generateRandomActivationCode();
        $user->activation_code = $code;
        $user->save();


        try {
            \Mail::to($user->email)->send(new ActivateAccount($user, $code));;

        } catch (\Exception $e) {

            // \Log::info($e->getMessage() . ' for account ' . $user->id);
            if ($logged == "true") {

                return redirect()->back()->withFlashDanger(__('labels.frontend.err_sending_mail'));
            } else {
                return false;
            }
        }

        // Send the OTP to the user phone
        try {
            // Get Sms token
            $token = config('taqnyat.token');
            $taqnyat = new TaqnyatSms($token);

            // Prepare the message
            $body = __('labels.frontend.auth.otp_body'). ' ' . $code;

            // Remove 00 or + from the start of the phone number
            $phone = $this->normalizePhoneNumber($user->phone);

            $recipients = [
                $phone
            ];
            $sender = app()->getLocale() == 'ar' ? 'شركة تمهير للتدريب' : 'Tamher Training';

            // Send the message
            $taqnyat->sendMsg($body, $recipients, $sender);

        } catch (\Exception $e) {
            if ($logged == "true") {

                return redirect()->back()->withFlashDanger(__('labels.frontend.err_sending_otp'));
            } else {
                return false;
            }
        }

        if ($logged == "true") {
            return redirect()->back();
        } else
            return true;
    }

    public function activate($id, $code, $admin = false)
    {
        $user = User::findOrFail($id);
        if ($user->is_activate = 1 && $user->confirmed = 1){
            return redirect()->route('frontend.auth.login')->withFlashSuccess(__('alerts.backend.users.already_confirmed'));
        }
        if ($code == $user->activation_code) {
            $user->is_activate = 1;
            $user->confirmed = 1;
            $user->activation_code = null;
            $user->save();
            if ($admin == false)
                return redirect()->route('frontend.auth.login')->withFlashSuccess(__('alerts.backend.users.confirmed'));
            else {

                return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.confirmed'));
            }
        } else {
            return redirect()->route('frontend.auth.login')->withFlashSuccess(__('alerts.backend.users.unconfirmed'));
        }
    }


    public function generateRandomActivationCode()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#&*$@';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 11; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass); //turn the array into a string

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
