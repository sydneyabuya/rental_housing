<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTenantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\User;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tenant = Tenant::all();
        // $tenant = Tenant::with('users')->get(); 
        $users=User::whereHas('roles', function($q) {
            $q->whereName('tenant');
        })->get();
        return view('admin.tenants.index', compact('users'));

        //return view('admin.tenants.index', compact('tenant'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('admin.tenants.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Tenant::create($request->all());
        $tenant=Tenant::create([
            'phone' => request('phone'),
            'user_id' => request('user->show')
        ]);

        //$auth()->user()->store($request->only('phone,user_id'));

        $tenant->users()->sync($request->input('users', []));

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant Added successfully.');
    }

    public function show(Tenant $tenant)
    {
        return view('admin.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  //  public function edit(Tenant $tenant)
    public function edit(UpdateTenantRequest $request)
    {

        $users = User::pluck('name', 'id');

        //$tenant->load('users');
        return view('admin.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $tenant->update($request->all());
        
        $tenant->users()->sync($request->input('users', []));

        return redirect()->route('admin.tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('admin.tenants.index');
    }
}