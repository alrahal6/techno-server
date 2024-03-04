<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Channel;
use App\Http\Requests\ChannelRequest;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $channels= Channel::all();
        return view('channels.index', ['channels'=>$channels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ChannelRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ChannelRequest $request)
    {
        $channel = new Channel;
		$channel->channel = $request->input('channel');
        $channel->save();

        return to_route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $channel = Channel::findOrFail($id);
        return view('channels.show',['channel'=>$channel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $channel = Channel::findOrFail($id);
        return view('channels.edit',['channel'=>$channel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ChannelRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChannelRequest $request, $id)
    {
        $channel = Channel::findOrFail($id);
		$channel->channel = $request->input('channel');
        $channel->save();

        return to_route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return to_route('channels.index');
    }
}
