<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Overload_delay_time;
use App\Http\Requests\Overload_delay_timeRequest;

class Overload_delay_timesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $overload_delay_times= Overload_delay_time::all();
        return view('overload_delay_times.index', ['overload_delay_times'=>$overload_delay_times]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('overload_delay_times.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Overload_delay_timeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Overload_delay_timeRequest $request)
    {
        $overload_delay_time = new Overload_delay_time;
		$overload_delay_time->meter_id = $request->input('meter_id');
		$overload_delay_time->channel = $request->input('channel');
		$overload_delay_time->seconds = $request->input('seconds');
        $overload_delay_time->save();

        return to_route('overload_delay_times.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $overload_delay_time = Overload_delay_time::findOrFail($id);
        return view('overload_delay_times.show',['overload_delay_time'=>$overload_delay_time]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $overload_delay_time = Overload_delay_time::findOrFail($id);
        return view('overload_delay_times.edit',['overload_delay_time'=>$overload_delay_time]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Overload_delay_timeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Overload_delay_timeRequest $request, $id)
    {
        $overload_delay_time = Overload_delay_time::findOrFail($id);
		$overload_delay_time->meter_id = $request->input('meter_id');
		$overload_delay_time->channel = $request->input('channel');
		$overload_delay_time->seconds = $request->input('seconds');
        $overload_delay_time->save();

        return to_route('overload_delay_times.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $overload_delay_time = Overload_delay_time::findOrFail($id);
        $overload_delay_time->delete();

        return to_route('overload_delay_times.index');
    }
}
