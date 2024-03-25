<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Unbalance_current;
use App\Http\Requests\Unbalance_currentRequest;

class Unbalance_currentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $unbalance_currents= Unbalance_current::all();
        return view('unbalance_currents.index', ['unbalance_currents'=>$unbalance_currents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('unbalance_currents.create',
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Unbalance_currentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Unbalance_currentRequest $request)
    {
        $unbalance_current = new Unbalance_current;
		$unbalance_current->meter_id = $request->input('meter_id');
		$unbalance_current->channel = $request->input('channel');
		$unbalance_current->ub_current = $request->input('ub_current');
        $unbalance_current->save();

        return to_route('unbalance_currents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $unbalance_current = Unbalance_current::findOrFail($id);
        return view('unbalance_currents.show',['unbalance_current'=>$unbalance_current]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $unbalance_current = Unbalance_current::findOrFail($id);
        return view('unbalance_currents.edit',['unbalance_current'=>$unbalance_current],
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Unbalance_currentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Unbalance_currentRequest $request, $id)
    {
        $unbalance_current = Unbalance_current::findOrFail($id);
		$unbalance_current->meter_id = $request->input('meter_id');
		$unbalance_current->channel = $request->input('channel');
		$unbalance_current->ub_current = $request->input('ub_current');
        $unbalance_current->save();

        return to_route('unbalance_currents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $unbalance_current = Unbalance_current::findOrFail($id);
        $unbalance_current->delete();

        return to_route('unbalance_currents.index');
    }
}
