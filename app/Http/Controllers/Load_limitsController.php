<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Load_limit;
use App\Http\Requests\Load_limitRequest;

class Load_limitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $load_limits= Load_limit::all();
        return view('load_limits.index', ['load_limits'=>$load_limits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('load_limits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Load_limitRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Load_limitRequest $request)
    {
        $load_limit = new Load_limit;
		$load_limit->meter_id = $request->input('meter_id');
		$load_limit->channel = $request->input('channel');
		$load_limit->load_limit = $request->input('load_limit');
        $load_limit->save();

        return to_route('load_limits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $load_limit = Load_limit::findOrFail($id);
        return view('load_limits.show',['load_limit'=>$load_limit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $load_limit = Load_limit::findOrFail($id);
        return view('load_limits.edit',['load_limit'=>$load_limit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Load_limitRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Load_limitRequest $request, $id)
    {
        $load_limit = Load_limit::findOrFail($id);
		$load_limit->meter_id = $request->input('meter_id');
		$load_limit->channel = $request->input('channel');
		$load_limit->load_limit = $request->input('load_limit');
        $load_limit->save();

        return to_route('load_limits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $load_limit = Load_limit::findOrFail($id);
        $load_limit->delete();

        return to_route('load_limits.index');
    }
}
