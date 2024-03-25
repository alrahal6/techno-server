<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Year;
use App\Http\Requests\YearRequest;

class YearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $years= Year::all();
        return view('years.index', ['years'=>$years]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('years.create',
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    private function saveEntry($request) {
        $this->commandGenerator->saveEntry($request->input('meter_id'),$request->input('channel'),Items::$year,$request->input('year'));
    }

    private function deleteEntry($request) {
        $this->commandGenerator->deleteEntry($request->meter_id,$request->channel,Items::$year);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  YearRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(YearRequest $request)
    {
        $year = new Year;
		$year->meter_id = $request->input('meter_id');
		$year->channel = $request->input('channel');
		$year->year = $request->input('year');
        $year->save();
        $this->saveEntry($request);
        return to_route('years.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $year = Year::findOrFail($id);
        return view('years.show',['year'=>$year]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $year = Year::findOrFail($id);
        return view('years.edit',['year'=>$year],
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  YearRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(YearRequest $request, $id)
    {
        $year = Year::findOrFail($id);
        $this->deleteEntry($year); 
		$year->meter_id = $request->input('meter_id');
		$year->channel = $request->input('channel');
		$year->year = $request->input('year');
        $year->save();
        $this->saveEntry($request);
        return to_route('years.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $year = Year::findOrFail($id);
        $this->deleteEntry($year); 
        $year->delete();

        return to_route('years.index');
    }
}
