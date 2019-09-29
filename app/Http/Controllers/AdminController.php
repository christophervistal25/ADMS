<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Appointment;
use App\CloseDay;
use App\Doctor;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // The importante key here all service must be ordered by id.
        $services = Service::count();
        
        /* start service for chart */
        $serviceNames = Service::orderBy('id', 'ASC')->pluck('name')->toJson();
        $appointmentsByService = Appointment::orderBy('service_id', 'ASC')->pluck('service_id');
        $s = array_values($appointmentsByService->countBy()->toArray());
        $noValues = array_fill(count($s) - 1, $services , 0);
        $serviceReport = json_encode($s + $noValues); // Equivalent to push or concat
        /* end of start service for chart */
        
        $appointments = Doctor::whereHas('appointments', function ($query) {
                $query->whereDate('start_date', date('Y-m-d'));
        })->withCount('appointments')->where('active', 'active')->get();
        $doctorsCount = Doctor::count();
        $patients = Patient::count();
        $closeDays = CloseDay::count();
        return view('admin.dashboard', compact('appointments', 'doctorsCount', 'patients', 'services', 'closeDays', 'serviceNames', 'serviceReport'));
    }

    public function edit()
    {
        return view('admin.auth.edit');
    }

    public function update(Request $request, Admin $admin)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$admin->id,
            'profile ' => 'nullable',
        ];
        
        if (!is_null($request->password) || !is_null($request->password_confirmation)) {
            $rules['password'] = $rules['password'] = 'required|min:8|confirmed';
        }
       
        $this->validate($request, $rules);

         if ($request->has('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => 150, "height"=> 150]);
            $admin->profile = $image_url;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        if (!is_null($request->password)) {
            $admin->password = $request->password;
        }
        $admin->save();

        return back()->with('success', 'Succesfully update your profile.');

    }
  
}
