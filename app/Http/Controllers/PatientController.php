<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use JD\Cloudder\Facades\Cloudder;

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
        return redirect()->route('appointment.index');
        return view('patient.dashboard');
    }

    public function edit()
    {
        $patient = Patient::with('info')->find(Auth::user()->id);
        return view('patient.edit', compact('patient'));
    }

    public function update(Request $request , Patient $patient)
    {
        $rules = [
            'name'           => 'required',
            'email'          => 'required|email|unique:patients,email,' . $patient->id,
            'mobile_no'      => 'required|unique:patients,mobile_no,'.$patient->id,
            'nickname'       => 'required',
            'birthdate'      => 'date',
            'martial_status' => ['required',Rule::in(['Single', 'Married', 'Divorced', 'Widowed'])],
            'sex'            => ['required',Rule::in(['Women', 'Men', 'Choose not to say'])],
            'occupation'     => 'required',
            'home_address'   => 'required',
            'profile'       => 'nullable',
        ];



        if ( !is_null($request->passwoord) || !is_null($request->password_confirmation)) {
            $rules['password'] = 'required|min:8|confirmed';
        }
        
        $this->validate($request, $rules);

        if ($request->has('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => 150, "height"=> 150]);
            $patient->profile = $image_url;
        }

        $information = new PatientInformation();
        $information->nickname       = $request->nickname;
        $information->birthdate      = $request->birthdate;
        $information->martial_status = $request->martial_status;
        $information->sex            = $request->sex;
        $information->occupation     = $request->occupation;
        $information->home_address   = $request->home_address;


        $patient->name      = $request->name;
        $patient->email     = $request->email;
        $patient->mobile_no = $request->mobile_no;
        
        if (!is_null($request->password)) {
            $patient->password = $request->password;
        }
        
        if (!is_null($patient->info)) {
            $patient->info->delete();    
        }
        
        $patient->info()->save($information);
        

        return back()->with('success', 'Succesfully update your profile.');
    }
}
