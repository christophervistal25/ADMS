<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Service;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->middleware('auth:admin');
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->service->all();
        return view('admin.services.index', compact('services'));
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
            'name' => 'required|unique:services',
            'price' => 'required',
            'per_each' => [Rule::in([0, 1])],
            'duration' => [Rule::in([1,2,3,4])],
        ]);

        $status = $this->service->create($request->all());

        return response()->json(['success' => $status]);
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
    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'name' => 'required|unique:services,name,' . $service->id,
            'price' => 'required',
            'per_each' => [Rule::in(['true', 'false'])],
            'duration' => [Rule::in([1,2,3,4])],
        ]);

        $status = $service->update($request->all());

        return response()->json(['success' => $status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $status = $service->delete();
        return response()->json(['success' => $status]);
    }
}
