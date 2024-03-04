<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Meter_location;
use App\Http\Requests\Meter_locationRequest;

class Meter_locationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $meter_locations= Meter_location::all();
        return view('meter_locations.index', ['meter_locations'=>$meter_locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('meter_locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Meter_locationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Meter_locationRequest $request)
    {
        $meter_location = new Meter_location;
		$meter_location->meter_id = $request->input('meter_id');
		$meter_location->location_id = $request->input('location_id');
        $meter_location->save();

        return to_route('meter_locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $meter_location = Meter_location::findOrFail($id);
        return view('meter_locations.show',['meter_location'=>$meter_location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $meter_location = Meter_location::findOrFail($id);
        return view('meter_locations.edit',['meter_location'=>$meter_location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Meter_locationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Meter_locationRequest $request, $id)
    {
        $meter_location = Meter_location::findOrFail($id);
		$meter_location->meter_id = $request->input('meter_id');
		$meter_location->location_id = $request->input('location_id');
        $meter_location->save();

        return to_route('meter_locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $meter_location = Meter_location::findOrFail($id);
        $meter_location->delete();

        return to_route('meter_locations.index');
    }
}
