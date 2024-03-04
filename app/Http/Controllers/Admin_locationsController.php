<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Admin_location;
use App\Http\Requests\Admin_locationRequest;

class Admin_locationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $admin_locations= Admin_location::all();
        return view('admin_locations.index', ['admin_locations'=>$admin_locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin_locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Admin_locationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Admin_locationRequest $request)
    {
        $admin_location = new Admin_location;
		$admin_location->admin_id = $request->input('admin_id');
		$admin_location->location_id = $request->input('location_id');
        $admin_location->save();

        return to_route('admin_locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $admin_location = Admin_location::findOrFail($id);
        return view('admin_locations.show',['admin_location'=>$admin_location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $admin_location = Admin_location::findOrFail($id);
        return view('admin_locations.edit',['admin_location'=>$admin_location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Admin_locationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Admin_locationRequest $request, $id)
    {
        $admin_location = Admin_location::findOrFail($id);
		$admin_location->admin_id = $request->input('admin_id');
		$admin_location->location_id = $request->input('location_id');
        $admin_location->save();

        return to_route('admin_locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $admin_location = Admin_location::findOrFail($id);
        $admin_location->delete();

        return to_route('admin_locations.index');
    }
}
