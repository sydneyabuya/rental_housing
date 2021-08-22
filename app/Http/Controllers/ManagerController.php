<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateManagerRequest;
use App\Models\Manager;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manager = Manager::all();

        return view('admin.manager.index', compact('manager'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Manager::create($request->all());

        return redirect()->route('admin.manager.index')->with('success', 'Property Manager created successfully.');
    }

    public function show(Manager $manager)
    {
        return view('admin.manager.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Manager $manager)
    // {
    //     //return view('admin.manager.edit', compact('manager'));
    // }

    public function edit(UpdateManagerRequest $request)
    {
        //return view('admin.manager.edit', compact('manager'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $manager->update($request->all());

        return redirect()->route('admin.manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        $manager->delete();

        return redirect()->route('admin.manager.index');
    }
}
