<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Monthly_tariff;
use App\Http\Requests\Monthly_tariffRequest;

class Monthly_tariffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $monthly_tariffs= Monthly_tariff::all();
        return view('monthly_tariffs.index', ['monthly_tariffs'=>$monthly_tariffs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('monthly_tariffs.create',
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Monthly_tariffRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Monthly_tariffRequest $request)
    {
        $monthly_tariff = new Monthly_tariff;
		$monthly_tariff->meter_id = $request->input('meter_id');
		$monthly_tariff->channel = $request->input('channel');
		$monthly_tariff->tariff = $request->input('tariff');
        $monthly_tariff->save();

        return to_route('monthly_tariffs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $monthly_tariff = Monthly_tariff::findOrFail($id);
        return view('monthly_tariffs.show',['monthly_tariff'=>$monthly_tariff]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $monthly_tariff = Monthly_tariff::findOrFail($id);
        return view('monthly_tariffs.edit',['monthly_tariff'=>$monthly_tariff],
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Monthly_tariffRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Monthly_tariffRequest $request, $id)
    {
        $monthly_tariff = Monthly_tariff::findOrFail($id);
		$monthly_tariff->meter_id = $request->input('meter_id');
		$monthly_tariff->channel = $request->input('channel');
		$monthly_tariff->tariff = $request->input('tariff');
        $monthly_tariff->save();

        return to_route('monthly_tariffs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $monthly_tariff = Monthly_tariff::findOrFail($id);
        $monthly_tariff->delete();

        return to_route('monthly_tariffs.index');
    }
}
