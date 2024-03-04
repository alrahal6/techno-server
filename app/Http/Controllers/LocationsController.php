<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Location;
use App\Http\Requests\LocationRequest;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $locations= Location::all();
        return view('locations.index', ['locations'=>$locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LocationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocationRequest $request)
    {
        $location = new Location;
		$location->id = $request->input('id');
		$location->locationname = $request->input('locationname');
		$location->address = $request->input('address');
		$location->lat = $request->input('lat');
		$location->lng = $request->input('lng');
        $location->save();

        return to_route('locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);
        return view('locations.show',['location'=>$location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('locations.edit',['location'=>$location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LocationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LocationRequest $request, $id)
    {
        $location = Location::findOrFail($id);
		$location->id = $request->input('id');
		$location->locationname = $request->input('locationname');
		$location->address = $request->input('address');
		$location->lat = $request->input('lat');
		$location->lng = $request->input('lng');
        $location->save();

        return to_route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return to_route('locations.index');
    }
}
