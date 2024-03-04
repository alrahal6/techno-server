<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Meter;
use App\Http\Requests\MeterRequest;

class MetersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $meters= Meter::all();
        return view('meters.index', ['meters'=>$meters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('meters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MeterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MeterRequest $request)
    {
        $meter = new Meter;
		$meter->meter_number = $request->input('meter_number');
		$meter->meter_name = $request->input('meter_name');
        $meter->save();

        return to_route('meters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $meter = Meter::findOrFail($id);
        return view('meters.show',['meter'=>$meter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $meter = Meter::findOrFail($id);
        return view('meters.edit',['meter'=>$meter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MeterRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MeterRequest $request, $id)
    {
        $meter = Meter::findOrFail($id);
		$meter->meter_number = $request->input('meter_number');
		$meter->meter_name = $request->input('meter_name');
        $meter->save();

        return to_route('meters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $meter = Meter::findOrFail($id);
        $meter->delete();

        return to_route('meters.index');
    }
}
