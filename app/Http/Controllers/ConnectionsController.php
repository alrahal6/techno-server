<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Connection;
use App\Http\Requests\ConnectionRequest;
use App\Models\ConnectionReport;

class ConnectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $connections= Connection::all();
        return view('connections.index', ['connections'=>$connections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('connections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ConnectionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConnectionRequest $request)
    {
        $connection = new Connection;
		$connection->number_of_meters = $request->input('number_of_meters');
		$connection->location_id = $request->input('location_id');
		$connection->connection_date = $request->input('connection_date');
		$connection->amc_per_connection = $request->input('amc_per_connection');
		$connection->connection_status = $request->input('connection_status');
		$connection->admin_name = $request->input('admin_name');
		$connection->amc_duration = $request->input('amc_duration');
        $connection->save();

        return to_route('connections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $connection = Connection::findOrFail($id);
        return view('connections.show',['connection'=>$connection]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $connection = Connection::findOrFail($id);
        return view('connections.edit',['connection'=>$connection]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ConnectionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ConnectionRequest $request, $id)
    {
        $connection = Connection::findOrFail($id);
		$connection->number_of_meters = $request->input('number_of_meters');
		$connection->location_id = $request->input('location_id');
		$connection->connection_date = $request->input('connection_date');
		$connection->amc_per_connection = $request->input('amc_per_connection');
		$connection->connection_status = $request->input('connection_status');
		$connection->admin_name = $request->input('admin_name');
		$connection->amc_duration = $request->input('amc_duration');
        $connection->save();

        return to_route('connections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $connection = Connection::findOrFail($id);
        $connection->delete();

        return to_route('connections.index');
    }

    public function connect() {
        //$connections= Connection::all();
        //return view('connections.index', ['connections'=>$connections]);
        return view('connections.connect');
    }

    public function report(ConnectionRequest $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Filter data based on date range
        //$reportData = ConnectionReport::filterByDateRange($startDate, $endDate)->get();
        $reportData = array();
        return view('connections.report', compact('reportData'));
    }
}
