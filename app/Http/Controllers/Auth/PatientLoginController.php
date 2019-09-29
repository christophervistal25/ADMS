<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PatientLoginController extends Controller
{
  use AuthenticatesUsers;


  	public function __construct()
  	{
  		$this->middleware('guest:patient')->except('logout');
  	}

  	public function login(Request $request)
  	{
  		  return view('patient.auth.login');
  	}

    public function loginPatient(Request $request)
    {
      $patient = Patient::where('email', $request->email)->first();
      if (is_null($patient->password)) {
          return redirect()->route('password.request', ['email' => $patient->email]);
      }
      // Attempt to log the user in
      if (Auth::guard('patient')->attempt(['email' => $request->email, 'password' => $request->password])) {
          // if successful, then redirect to their intended location
          return redirect()->route('patient.dashboard');
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'))
                              ->withErrors(['message' => 'Invalid Email or Password.']);
    }

    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patient.auth.login');
    }
}
