<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMaintenanceRequest;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Models\Maintenance;
use App\Models\Property;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('maintenance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = Auth::user()->id;

        $maintenances = Maintenance::with(['user', 'property', 'unit'])->where('user_id',$users)->get();

        return view('frontend.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintenance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.maintenances.create', compact('users', 'properties', 'units'));
    }

    public function store(StoreMaintenanceRequest $request)
    {
        $maintenance = Maintenance::create($request->all());

        return redirect()->route('frontend.maintenances.index');
    }

    public function edit(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenance->load('user', 'property', 'unit');

        return view('frontend.maintenances.edit', compact('users', 'properties', 'units', 'maintenance'));
    }

    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->all());

        return redirect()->route('frontend.maintenances.index');
    }

    public function show(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenance->load('user', 'property', 'unit');

        return view('frontend.maintenances.show', compact('maintenance'));
    }

    public function destroy(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenance->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintenanceRequest $request)
    {
        Maintenance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
