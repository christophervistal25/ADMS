<?php

namespace App\Http\Controllers\Admin;

use App\CloseDay;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CloseDaysController extends Controller
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
        $dates = CloseDay::all();
        return view('admin.close.index', compact('dates'));
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
        dd($request->all());
        
        $this->validate($request, [
            'start' => 'date',
            'end'   => 'date',
        ]);

        CloseDay::create([
            'start' => Carbon::parse($request->start),
            'end'   => Carbon::parse($request->end),
        ]);
        return response()->json(['success' => true]);
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
    public function update(Request $request, CloseDay $close)
    {
        $this->validate($request, [
            'start' => 'date',
            'end'   => 'date',
        ]);

        $updated = $close->update([
            'start' => Carbon::parse($request->start),
            'end'   => Carbon::parse($request->end),
        ]);
        
        return response()->json(['success' => $updated]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CloseDay $close)
    {
        return response()->json(['success' => $close->delete()]);
    }
}
