<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/patient/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:patient');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset',[
            'title' => 'Reset your password',
            'token' => $token,
        ]);
    }

    protected function resetPassword($patient, $password)
    {
        $patient->forceFill([
            'password' => $password,
            'remember_token' => str_random(60),
        ])->save();

        $this->guard()->login($patient);
    }

    protected function guard()
    {
        return Auth::guard('patient');
    }

    public function broker()
    {
        return Password::broker('patients');
    }
}
