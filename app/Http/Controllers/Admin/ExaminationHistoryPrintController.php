<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ExaminationHistoryPrintController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth:admin');
	}
	
    public function print($recordIds)
    {
        preg_match_all('!\d+!', $recordIds, $ids);
        $ids = array_shift($ids);
    	$records = Examination::with('teeths:id,examination_id,tooth_description,surface,treatment')->find($ids, ['id','created_at']);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
    	$pdf->loadView('admin.examinationrecords.print', compact('records'));
		return $pdf->stream();
    }
}
