<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;
use Auth;

class PatientRegisterController extends Controller
{
    public function __construct(Patient $patient)
    {
        $this->middleware('guest:patient');
        $this->patient = $patient;
    }


    public function register()
    {
        return view('patient.auth.register');   
    }

    public function registerPatient(Request $request)
    {
        $this->validate($request, [
            'firstname'  => 'required',
            'middlename' => 'required',
            'lastname'   => 'required',
            'email'      => 'required|unique:patients',
            'mobile_no'  => 'required|unique:patients',
            'password'   => 'required|min:8|max:20|confirmed',
        ]);
        $patient = $this->patient->create($request->all());
        Auth::guard('patient')->login($patient);
        return redirect()->intended(route('account.settings'));
    }
}
