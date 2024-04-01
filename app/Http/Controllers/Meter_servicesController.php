<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Meter_service;
use App\Http\Requests\Meter_serviceRequest;

class Meter_servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $meter_services= Meter_service::all();
        return view('meter_services.index', ['meter_services'=>$meter_services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('meter_services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Meter_serviceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Meter_serviceRequest $request)
    {
        $meter_service = new Meter_service;
		$meter_service->meter_id = $request->input('meter_id');
		$meter_service->service_status = $request->input('service_status');
		$meter_service->problem_note = $request->input('problem_note');
		$meter_service->service_note = $request->input('service_note');
        $meter_service->save();

        return to_route('meter_services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $meter_service = Meter_service::findOrFail($id);
        return view('meter_services.show',['meter_service'=>$meter_service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $meter_service = Meter_service::findOrFail($id);
        return view('meter_services.edit',['meter_service'=>$meter_service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Meter_serviceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Meter_serviceRequest $request, $id)
    {
        $meter_service = Meter_service::findOrFail($id);
		$meter_service->meter_id = $request->input('meter_id');
		$meter_service->service_status = $request->input('service_status');
		$meter_service->problem_note = $request->input('problem_note');
		$meter_service->service_note = $request->input('service_note');
        $meter_service->save();

        return to_route('meter_services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $meter_service = Meter_service::findOrFail($id);
        $meter_service->delete();

        return to_route('meter_services.index');
    }
}
