<?php

namespace App\Http\Controllers\Patient;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class AppointmentConfirmation extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:patient');
	}
	
    public function print(Appointment $appointment)
    {
      	$pdf = PDF::loadView('patient.appointment.print_forms.confirmation', compact('appointment'));
		return $pdf->stream('invoice.pdf');
    }
}
