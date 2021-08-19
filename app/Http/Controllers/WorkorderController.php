<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workorder;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workorder = Workorder::all();

        return view('admin.workorder.index', compact('workorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workorder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Workorder::create($request->all());

        return redirect()->route('admin.workorder.index')->with('success', 'Work Order Made successfully.');
    }

    public function show(Workorder $workorder)
    {
        return view('admin.workorder.show', compact('workorder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Workorder $workorder)
    {
        return view('admin.workorder.edit', compact('workorder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workorder $workorder)
    {
        $workorder->update($request->all());

        return redirect()->route('admin.workorder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workorder $workorder)
    {
        $workorder->delete();

        return redirect()->route('admin.workorder.index');
    }
}
