<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class PatientController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:patient');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patient.dashboard');
    }

    public function edit()
    {
        return view('patient.edit');
    }

    public function update(Request $request , Patient $patient)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:patients,email,' . $patient->id,
            'mobile_no' => 'required|unique:patients,mobile_no,'.$patient->id,
        ];

        if ( !is_null($request->passwoord) || !is_null($request->password_confirmation)) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        $this->validate($request, $rules);
        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->mobile_no = $request->mobile_no;
        if (!is_null($request->password)) {
            $patient->password = $request->password;
        }
        $patient->save();
        return back()->with('success', 'Succesfully update your profile.');
    }
}
