<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(Doctor $doctor)
    {
        $this->middleware('auth:admin');
        $this->doctor = $doctor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = $this->doctor->where('active', 'active')->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'title' => 'required',
        ]);

        $this->doctor->create($request->all());

        return response()->json(['success' => true]);
    }

    /**
     * Display doctors appointments
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        $services = Service::all();
        return view('admin.doctor.appointments', compact('doctor', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'title'    => 'required',
        ]);

        $update = $doctor->update($request->all());
        return response()->json(['success' => $update, 'doctor' => $doctor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $delete = $doctor->update(['active' => 'in-active']);
        return response()->json(['success' => $delete]);
    }
}
