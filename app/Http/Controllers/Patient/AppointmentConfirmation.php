<?php

namespace App\Http\Controllers\Patient;

use App\Admin;
use App\Appointment;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


class AppointmentConfirmation extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:patient');
	}
	
    public function print(Appointment $appointment)
    {
    	$mobile_no = Admin::MOBILE_NO;
      	$pdf = PDF::loadView('patient.appointment.print_forms.confirmation', compact('appointment', 'mobile_no'));
		return $pdf->stream('invoice.pdf');
    }
}
