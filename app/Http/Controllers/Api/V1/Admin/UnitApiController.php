<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Resources\Admin\UnitResource;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnitApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnitResource(Unit::with(['property', 'property_units'])->get());
    }

    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->all());
        $unit->property_units()->sync($request->input('property_units', []));

        return (new UnitResource($unit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnitResource($unit->load(['property', 'property_units']));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        $unit->property_units()->sync($request->input('property_units', []));

        return (new UnitResource($unit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Unit $unit)
    {
        abort_if(Gate::denies('unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
