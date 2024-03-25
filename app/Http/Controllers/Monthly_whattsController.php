<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Monthly_whatt;
use App\Http\Requests\Monthly_whattRequest;

class Monthly_whattsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $monthly_whatts= Monthly_whatt::all();
        return view('monthly_whatts.index', ['monthly_whatts'=>$monthly_whatts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('monthly_whatts.create',
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Monthly_whattRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Monthly_whattRequest $request)
    {
        $monthly_whatt = new Monthly_whatt;
		$monthly_whatt->meter_id = $request->input('meter_id');
		$monthly_whatt->channel = $request->input('channel');
		$monthly_whatt->whatt = $request->input('whatt');
        $monthly_whatt->save();

        return to_route('monthly_whatts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $monthly_whatt = Monthly_whatt::findOrFail($id);
        return view('monthly_whatts.show',['monthly_whatt'=>$monthly_whatt]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $monthly_whatt = Monthly_whatt::findOrFail($id);
        return view('monthly_whatts.edit',['monthly_whatt'=>$monthly_whatt],
        ['meters'=>Items::getMeter(),'channels' => Items::getChannel()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Monthly_whattRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Monthly_whattRequest $request, $id)
    {
        $monthly_whatt = Monthly_whatt::findOrFail($id);
		$monthly_whatt->meter_id = $request->input('meter_id');
		$monthly_whatt->channel = $request->input('channel');
		$monthly_whatt->whatt = $request->input('whatt');
        $monthly_whatt->save();

        return to_route('monthly_whatts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $monthly_whatt = Monthly_whatt::findOrFail($id);
        $monthly_whatt->delete();

        return to_route('monthly_whatts.index');
    }
}
