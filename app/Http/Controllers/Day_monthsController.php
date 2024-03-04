<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Day_month;
use App\Http\Requests\Day_monthRequest;

class Day_monthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $day_months= Day_month::all();
        return view('day_months.index', ['day_months'=>$day_months]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('day_months.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Day_monthRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Day_monthRequest $request)
    {
        $day_month = new Day_month;
		$day_month->meter_id = $request->input('meter_id');
		$day_month->channel = $request->input('channel');
		$day_month->day = $request->input('day');
		$day_month->month = $request->input('month');
        $day_month->save();

        return to_route('day_months.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $day_month = Day_month::findOrFail($id);
        return view('day_months.show',['day_month'=>$day_month]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $day_month = Day_month::findOrFail($id);
        return view('day_months.edit',['day_month'=>$day_month]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Day_monthRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Day_monthRequest $request, $id)
    {
        $day_month = Day_month::findOrFail($id);
		$day_month->meter_id = $request->input('meter_id');
		$day_month->channel = $request->input('channel');
		$day_month->day = $request->input('day');
		$day_month->month = $request->input('month');
        $day_month->save();

        return to_route('day_months.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $day_month = Day_month::findOrFail($id);
        $day_month->delete();

        return to_route('day_months.index');
    }
}
