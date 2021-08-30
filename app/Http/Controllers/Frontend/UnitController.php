<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUnitRequest;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Property;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnitController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::with(['property', 'property_units'])->get();

        return view('frontend.units.index', compact('units'));
    }

    public function create()
    {
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_units = Property::pluck('name', 'id');

        return view('frontend.units.create', compact('properties', 'property_units'));
    }

    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->all());
        $unit->property_units()->sync($request->input('property_units', []));

        return redirect()->route('frontend.units.index');
    }

    public function edit(Unit $unit)
    {
        abort_if(Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_units = Property::pluck('name', 'id');

        $unit->load('property', 'property_units');

        return view('frontend.units.edit', compact('properties', 'property_units', 'unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        $unit->property_units()->sync($request->input('property_units', []));

        return redirect()->route('frontend.units.index');
    }

    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->load('property', 'property_units', 'statusLeases');

        return view('frontend.units.show', compact('unit'));
    }

    public function destroy(Unit $unit)
    {
        abort_if(Gate::denies('unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnitRequest $request)
    {
        Unit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
