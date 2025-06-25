<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Forms;
use App\Models\Auth\User;
use App\Models\TrainingData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        // $trainingData=TrainingData::first();
        $trainingData=Forms::Latest()->where('form_type','training_data')->first();
     
    
        return view('backend.account.index',compact('user','trainingData'));
    }
    public function index2(Request $request)
    {
        $user = auth()->user();
        // $trainingData=TrainingData::first();
        $trainingData=Forms::Latest()->where('form_type','training_data')->first();
     
    
        return view('backend.account.index2',compact('user','trainingData'));
    }
    public function publicTrainingDataForm(Request $request)
    {
       
        $trainingData=Forms::Latest()->where('form_type','training_data')->first();
     
    
        return view('backend.account.tabs.trainingDataFormPublic',compact('trainingData'));
    }

    public function deactivateAccount(Request $request)
    {
        $email = auth()->user()->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withFlashDanger(__('user not found'));
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withFlashDanger(__('Incorrect current password.'));
        }

        if ($request->has('allow_personal_info')) {
            $user->update(['allow_personal_info' => true]);
        } else {
            $user->update(['allow_personal_info' => false]);
            Auth::logout();
            return redirect()->back()->withFlashSuccess(__('You have been logged out due to privacy preferences.'));
        }

        if ($request->action === 'is_activate') {
            $user->update(['is_activate' => true]);
            return redirect()->back()->withFlashSuccess(__('alerts.backend.users.account_disabled'));
        } elseif ($request->action === 'delete') {
            $user->delete();
            return redirect()->back()->withFlashSuccess(__('alerts.backend.users.deleted'));
        }

        return redirect()->back()->withFlashSuccess(__('Your preferences have been updated.'));
    }
}