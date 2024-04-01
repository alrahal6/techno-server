<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Connection_status;
use App\Http\Requests\Connection_statusRequest;

class Connection_statusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $connection_statuses= Connection_status::all();
        return view('connection_statuses.index', ['connection_statuses'=>$connection_statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('connection_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Connection_statusRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Connection_statusRequest $request)
    {
        $connection_status = new Connection_status;
		$connection_status->status_name = $request->input('status_name');
        $connection_status->save();

        return to_route('connection_statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $connection_status = Connection_status::findOrFail($id);
        return view('connection_statuses.show',['connection_status'=>$connection_status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $connection_status = Connection_status::findOrFail($id);
        return view('connection_statuses.edit',['connection_status'=>$connection_status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Connection_statusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Connection_statusRequest $request, $id)
    {
        $connection_status = Connection_status::findOrFail($id);
		$connection_status->status_name = $request->input('status_name');
        $connection_status->save();

        return to_route('connection_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $connection_status = Connection_status::findOrFail($id);
        $connection_status->delete();

        return to_route('connection_statuses.index');
    }
}
