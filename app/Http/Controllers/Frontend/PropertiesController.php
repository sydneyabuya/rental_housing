<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPropertyRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertiesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('property_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::all();

        return view('frontend.properties.index', compact('properties'));
    }

    public function create()
    {
        abort_if(Gate::denies('property_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.properties.create');
    }

    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->all());

        return redirect()->route('frontend.properties.index');
    }

    public function edit(Property $property)
    {
        abort_if(Gate::denies('property_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.properties.edit', compact('property'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $property->update($request->all());

        return redirect()->route('frontend.properties.index');
    }

    public function show(Property $property)
    {
        abort_if(Gate::denies('property_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.properties.show', compact('property'));
    }

    public function destroy(Property $property)
    {
        abort_if(Gate::denies('property_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $property->delete();

        return back();
    }

    public function massDestroy(MassDestroyPropertyRequest $request)
    {
        Property::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
