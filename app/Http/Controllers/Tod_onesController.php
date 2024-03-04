<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Tod_one;
use App\Http\Requests\Tod_oneRequest;

class Tod_onesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tod_ones= Tod_one::all();
        return view('tod_ones.index', ['tod_ones'=>$tod_ones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tod_ones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Tod_oneRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Tod_oneRequest $request)
    {
        $tod_one = new Tod_one;
		$tod_one->meter_id = $request->input('meter_id');
		$tod_one->channel = $request->input('channel');
		$tod_one->starttime = $request->input('starttime');
		$tod_one->endtime = $request->input('endtime');
        $tod_one->save();

        return to_route('tod_ones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $tod_one = Tod_one::findOrFail($id);
        return view('tod_ones.show',['tod_one'=>$tod_one]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $tod_one = Tod_one::findOrFail($id);
        return view('tod_ones.edit',['tod_one'=>$tod_one]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Tod_oneRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tod_oneRequest $request, $id)
    {
        $tod_one = Tod_one::findOrFail($id);
		$tod_one->meter_id = $request->input('meter_id');
		$tod_one->channel = $request->input('channel');
		$tod_one->starttime = $request->input('starttime');
		$tod_one->endtime = $request->input('endtime');
        $tod_one->save();

        return to_route('tod_ones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tod_one = Tod_one::findOrFail($id);
        $tod_one->delete();

        return to_route('tod_ones.index');
    }
}
