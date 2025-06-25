<?php

namespace App\Http\Controllers\Backend\Auth\User;

use Carbon\Carbon;
use App\Exceptions\GeneralException;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserPasswordRequest;
use App\Http\Requests\Frontend\User\UpdatePasswordRequest;
use App\Rules\Auth\ChangePassword;
use App\Rules\Auth\UnusedPassword;
use Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;

/**
 * Class UserPasswordController.
 */
class UserPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, User $user)
    {

        return view('backend.account.index')
            ->withUser($user);
    }

    /**
     * @param UpdateUserPasswordRequest $request
     * @param string                      $email
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdatePasswordRequest $request, $email)
    {

        $user = User::where('email', $email)->first();
        if ($user) {
            $this->userRepository->updatePassword($user, $request->validated());
            // $user=auth()->user();
    
                        $date = Carbon::now();
        
                        $user->update(['last_login_at' => $date]);
            return redirect()->back()->withFlashSuccess(__('alerts.backend.users.updated_password'));
        } else {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.users.update_password_error'));
        }
    }

    // ***************
    public function update2(Request $request, $email)
    {

        $validator = Validator::make(Input::all(), [
            'old_password' => [Rule::requiredIf(!auth()->user()->isAdmin())],
            'password'     => [
                'required',
                'confirmed',
            ],
        ]);
// ******
        $user = User::where('email', $email)->first();
        if($user) {
           
           try {
               //code...
               $this->userRepository->updatePassword($user, $request->all());
                 
                        $user=auth()->user();
    
                        $date = Carbon::now();
        
                        $user->update(['last_login_at' => $date]);
                        
                // return redirect()->back()->withFlashSuccess(__('alerts.backend.users.updated_password'));
                return redirect()->route('frontend.auth.logout2');
               
           } catch (\Throwable $th) {
               //throw $th;
               return redirect()->route('frontend.auth.logout2');

            // return redirect()->back()->withFlashDanger('old password mismatch');
        //    view('backend.account.tabs.change_password1',compact('user'))->withFlashDanger(__('exceptions.backend.access.users.update_password_error'));
           }
        
           
            // view('backend.account.index')
            // ->withUser($user)->withFlashSuccess(__('alerts.backend.users.updated_password'));
                 
        }
        else{
            // dd("ff");
            // view('backend.account.index')
            // ->withUser($user)->withFlashDanger(__('exceptions.backend.access.users.update_password_error'));
            // return redirect()->route('frontend.auth.logout2');
             return view('backend.account.tabs.change_password1',compact('user'))->withFlashDanger(__('exceptions.backend.access.users.update_password_error'));
            // throw new GeneralException(__('exceptions.frontend.auth.password.change_mismatch'));
      
            // return redirect()->back()->withFlashDanger(__('exceptions.backend.access.users.update_password_error'));
        }
         
    }
}
