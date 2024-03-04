<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Tod_two;
use App\Http\Requests\Tod_twoRequest;

class Tod_twosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tod_twos= Tod_two::all();
        return view('tod_twos.index', ['tod_twos'=>$tod_twos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tod_twos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Tod_twoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Tod_twoRequest $request)
    {
        $tod_two = new Tod_two;
		$tod_two->meter_id = $request->input('meter_id');
		$tod_two->channel = $request->input('channel');
		$tod_two->starttime = $request->input('starttime');
		$tod_two->endtime = $request->input('endtime');
        $tod_two->save();

        return to_route('tod_twos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $tod_two = Tod_two::findOrFail($id);
        return view('tod_twos.show',['tod_two'=>$tod_two]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $tod_two = Tod_two::findOrFail($id);
        return view('tod_twos.edit',['tod_two'=>$tod_two]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Tod_twoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tod_twoRequest $request, $id)
    {
        $tod_two = Tod_two::findOrFail($id);
		$tod_two->meter_id = $request->input('meter_id');
		$tod_two->channel = $request->input('channel');
		$tod_two->starttime = $request->input('starttime');
		$tod_two->endtime = $request->input('endtime');
        $tod_two->save();

        return to_route('tod_twos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tod_two = Tod_two::findOrFail($id);
        $tod_two->delete();

        return to_route('tod_twos.index');
    }
}
