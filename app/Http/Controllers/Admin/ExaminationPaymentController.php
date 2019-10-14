<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Service;
use Illuminate\Http\Request;

class ExaminationPaymentController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Examination  $id
     * @param  No of tooth  $noOfTooth
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, int $noOfTooth)
    {
        $examination = Examination::with('patient')->find($id);
        $services = Service::get(['id', 'name', 'price', 'per_each']);
        return view('admin.payment.create', compact('examination', 'noOfTooth', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Examination ID int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $examination = Examination::with('patient')->find($id);
        $services = Service::get(['id', 'name', 'price', 'per_each']);

        $payment = Payment::find($id) ?? new Payment();
        $payment->service_rendered = $request->service_rendered;
        $payment->fee              = $request->service_amount;
        $payment->paid             = $request->fee;
        $payment->balance          = $request->service_amount - $request->fee;
        $examination->payments()->save($payment);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.payment.print', compact('examination', 'payment'));
        return $pdf->stream();
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
