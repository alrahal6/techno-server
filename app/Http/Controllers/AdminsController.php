<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Http\Requests\AdminRequest;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $admins= Admin::all();
        return view('admins.index', ['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        $admin = new Admin;
		$admin->adminname = $request->input('adminname');
		$admin->mobile = $request->input('mobile');
        $admin->save();

        return to_route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.show',['admin'=>$admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.edit',['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
		$admin->adminname = $request->input('adminname');
		$admin->mobile = $request->input('mobile');
        $admin->save();

        return to_route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return to_route('admins.index');
    }
}
