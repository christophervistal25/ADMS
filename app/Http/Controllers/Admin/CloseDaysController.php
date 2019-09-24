<?php

namespace App\Http\Controllers\Admin;

use App\CloseDay;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CloseDayRepositories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CloseDaysController extends Controller
{
    public function __construct(CloseDayRepositories $closeDayRepo)
    {
        $this->middleware('auth:admin');
        $this->closeDayRepo = $closeDayRepo;
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

        $this->validate($request, [
            'start' => 'date',
            'end'   => 'date',
        ]);

        $start   = Carbon::parse($request->start);
        $end     = Carbon::parse($request->end);
        $all_day = $this->closeDayRepo->isAllDay($start, $end);
        
        CloseDay::create([
            'start'   => $start,
            'end'     => $end,
            'all_day' => $all_day,
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

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $all_day = $this->closeDayRepo->isAllDay($start, $end);

        $updated = $close->update([
            'start'   => $start,
            'end'     => $end,
            'all_day' => $all_day
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
