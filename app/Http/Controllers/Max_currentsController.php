<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Max_current;
use App\Http\Requests\Max_currentRequest;

class Max_currentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $max_currents= Max_current::all();
        return view('max_currents.index', ['max_currents'=>$max_currents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('max_currents.create',
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Max_currentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Max_currentRequest $request)
    {
        $max_current = new Max_current;
		$max_current->meter_id = $request->input('meter_id');
		$max_current->channel = $request->input('channel');
		$max_current->mx_current = $request->input('mx_current');
        $max_current->save();

        return to_route('max_currents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $max_current = Max_current::findOrFail($id);
        return view('max_currents.show',['max_current'=>$max_current]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $max_current = Max_current::findOrFail($id);
        return view('max_currents.edit',['max_current'=>$max_current],
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Max_currentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Max_currentRequest $request, $id)
    {
        $max_current = Max_current::findOrFail($id);
		$max_current->meter_id = $request->input('meter_id');
		$max_current->channel = $request->input('channel');
		$max_current->mx_current = $request->input('mx_current');
        $max_current->save();

        return to_route('max_currents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $max_current = Max_current::findOrFail($id);
        $max_current->delete();

        return to_route('max_currents.index');
    }
}
