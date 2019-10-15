<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AddRequest;
use App\Http\Resources\DoctorAppointmentResource;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorAppointmentController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $this->validate($request, [

        ]);

         DB::beginTransaction();
         try {
            $appointment = Appointment::create([
                'service_id' => $request->service_id,
                'doctor_id'  => $request->doctor_id,
                'start_date' => Carbon::parse($request->start_date),
                'end_date'   => Carbon::parse($request->end_date),
            ]);

            $patient = Patient::find($request->patient_id);

            $appointment->patients()->attach($patient);

            DB::commit();
            return response()->json(['success' => true, 'appointment_id' => $appointment->id]);
         } catch (Exception $e) {
            DB::rollback();
         }
    }

    /**
     * Display the appointments of doctor today.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        // $doctor = Doctor::with(['appointments'])->find($id);
        // $appointments = DoctorAppointmentResource::collection($doctor->appointments);
        $appointments = Appointment::with(['service', 'doctor' => function ($query) use ($id ){
            $query->where('id', $id);
        }, 'patients'])->get();
        $appointments = DoctorAppointmentResource::collection($appointments);
        return response()->json($appointments);
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
    public function update(Request $request, $id)
    {
        $appointment             = Appointment::find($id);
        $appointment->service_id = $request->service;
        $appointment->start_date = $request->start_date;
        $appointment->end_date   = $request->end_date;
        $status                  = $appointment->save();
        return response()->json(['success' => $status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
