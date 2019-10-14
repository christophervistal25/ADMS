<?php

namespace App\Http\Controllers\Admin;

use App\Examination;
use App\ExaminationToothChart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Examination\AddRequest;
use App\Http\Requests\Examination\UpdateRequest;
use App\Patient;
use DB;
use Exepction;
use Illuminate\Http\Request;


class PatientExaminationRecordController extends Controller
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
     * History record of patient 
     * Displayling all examination Records.
     */
    public function history($patient)
    {
        $records = Patient::with(['examinations:id,patient_id,created_at','examinations.teeths:examination_id,surface,tooth_description,treatment'])
                            ->find($patient);
        return view('admin.examinationrecords.history', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        return view('admin.examinationrecords.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request, Patient $patient)
    {
         DB::beginTransaction();
         try {
            $examination = new Examination();
            $examination->occlusion             = $request->occlusion;
            $examination->periodontal_condition =  $request->periodontal_condition;
            $examination->oral_hygiene          = $request->oral_hygiene;
            $examination->denture_lower         = ($request->denture_lower === 'on') ? 1 : 0 ?? 0;
            $examination->denture_upper         = ($request->denture_upper === 'on') ? 1 : 0 ?? 0;
            $examination->denture_upper_since   = $request->denture_upper_since;
            $examination->denture_lower_since   = $request->denture_lower_since;
            $examination->abnormalities         = $request->abnormalities;
            $examination->general_condition     = $request->general_condition;
            $examination->physician             = $request->physician;
            $examination->nature_of_treatment   = $request->nature_of_treatment;
            $examination->allergies             = $request->allergies;
            $examination->history_bleeding      = $request->previous_bleeding_history;
            $examination->chronic_ailment       = $request->chronic_ailment;
            $examination->blood_pressure        = $request->blood_pressure;
            $examination->drugs_taken           = $request->drugs_taken;

            $examination = $patient->examinations()->save($examination);
            $teeths = [];
            foreach ($request->teeths['numbers'] as $index => $tooth_number) {
                $teeths[] = new ExaminationToothChart([
                    'tooth_number'      => $tooth_number, 
                    'tooth_description' => $request->teeths['descriptions'][$index], 
                    'treatment'         => $request->teeths['treatments'][$index],
                    'surface'            => $request->teeths['surfaces'][$index],
                    'status'            => $request->teeths['statuses'][$index],
                ]);
            }
            $examination->teeths()->saveMany($teeths);
            DB::commit();
            return response()->json(['success' => true, 'examination_id' => $examination->id, 'no_of_tooths' => count($request->teeths['numbers']) ]);
         } catch (Exception $e) {
            return response()->json(['success' => false]);
            DB::rollback();
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($examinationId)
    {
        $record = Examination::with(['teeths'])->find($examinationId);
        return view('admin.examinationrecords.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($examinationId)
    {
        $record = Examination::with(['teeths'])->find($examinationId);
        return view('admin.examinationrecords.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if (is_null($request->patient_id)) {
            return response()->json(['success' => false], 404);
        }
        DB::beginTransaction();
         try {
            $examination = Examination::find($id);
            $examination->patient_id            = $request->patient_id;
            $examination->occlusion             = $request->occlusion;
            $examination->periodontal_condition =  $request->periodontal_condition;
            $examination->oral_hygiene          = $request->oral_hygiene;
            $examination->denture_lower         = ($request->denture_lower === 'on') ? 1 : 0 ?? 0;
            $examination->denture_upper         = ($request->denture_upper === 'on') ? 1 : 0 ?? 0;
            $examination->denture_upper_since   = $request->denture_upper_since;
            $examination->denture_lower_since   = $request->denture_lower_since;
            $examination->abnormalities         = $request->abnormalities;
            $examination->general_condition     = $request->general_condition;
            $examination->physician             = $request->physician;
            $examination->nature_of_treatment   = $request->nature_of_treatment;
            $examination->allergies             = $request->allergies;
            $examination->history_bleeding      = $request->previous_bleeding_history;
            $examination->chronic_ailment       = $request->chronic_ailment;
            $examination->blood_pressure        = $request->blood_pressure;
            $examination->drugs_taken           = $request->drugs_taken;
            $examination->save();
            $teeths = [];
            foreach ($request->teeths['numbers'] as $index => $tooth_number) {
                $teeths[] = new ExaminationToothChart([
                    'tooth_number'      => $tooth_number, 
                    'tooth_description' => $request->teeths['descriptions'][$index], 
                    'treatment'         => $request->teeths['treatments'][$index],
                    'surface'           => $request->teeths['surfaces'][$index],
                    'status'            => $request->teeths['statuses'][$index],
                ]);
            }
            $examination->teeths()->delete();
            $examination->teeths()->saveMany($teeths);
            DB::commit();
            return response()->json(['success' => true]);
         } catch (Exception $e) {
            return response()->json(['success' => false]);
            DB::rollback();
         }
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
