<?php

namespace App\Http\Controllers\Patient;

use App\Appointment;
use App\CloseDay;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AppointmentRepository;
use App\Patient;
use App\Service;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->middleware('auth:patient');
        $this->appointmentRepo = $appointmentRepository;
    }

    public function getAvailables(string $date, int $doctorId, string $duration)
    {
        list($month, $day , $year) = explode('-', $date); 

        $dates = DB::table('appointments')
                    ->where('doctor_id', $doctorId)
                    ->whereMonth('start_date', $month)
                    ->whereDay('start_date', $day)
                    ->whereYear('start_date', $year)
                    ->orderBy('start_date', 'ASC')
                    ->get(['start_date', 'end_date']);

        $timeClose = CloseDay::byTime($month, $day);
        $availables = $this->appointmentRepo->findAvailableFor($dates, $duration);

        return response()->json(['availables' => $availables, 'time_close' => $timeClose]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::getAppointments(Auth::user()->id);
        return view('patient.appointment.index', compact('patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $closeDays = CloseDay::allDay();
        $doctors = Doctor::active()->get();
        $services = Service::all();
        return view('patient.appointment.create', compact('doctors', 'services', 'closeDays'));
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
            'service_id' => 'required',
            'doctor'     => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ]);

         DB::beginTransaction();
         try {
            $appointment = Appointment::create([
                'service_id' => $request->service_id,
                'doctor_id'  => $request->doctor,
                'start_date' => Carbon::parse($request->start_date),
                'end_date'   => Carbon::parse($request->end_date),
            ]);

            $patient = Patient::find(Auth::user()->id);

            $appointment->patients()->attach($patient);

            DB::commit();
            return response()->json(['success' => true, 'appointment_id' => $appointment->id]);
         } catch (Exception $e) {
            DB::rollback();
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
 
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
        //
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
