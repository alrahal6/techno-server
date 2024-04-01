<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Service_status;
use App\Http\Requests\Service_statusRequest;

class Service_statusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $service_statuses= Service_status::all();
        return view('service_statuses.index', ['service_statuses'=>$service_statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('service_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Service_statusRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Service_statusRequest $request)
    {
        $service_status = new Service_status;
		$service_status->status_name = $request->input('status_name');
        $service_status->save();

        return to_route('service_statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $service_status = Service_status::findOrFail($id);
        return view('service_statuses.show',['service_status'=>$service_status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $service_status = Service_status::findOrFail($id);
        return view('service_statuses.edit',['service_status'=>$service_status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Service_statusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Service_statusRequest $request, $id)
    {
        $service_status = Service_status::findOrFail($id);
		$service_status->status_name = $request->input('status_name');
        $service_status->save();

        return to_route('service_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $service_status = Service_status::findOrFail($id);
        $service_status->delete();

        return to_route('service_statuses.index');
    }
}
