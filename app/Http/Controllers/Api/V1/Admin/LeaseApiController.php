<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdateLeaseRequest;
use App\Http\Resources\Admin\LeaseResource;
use App\Models\Lease;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeaseResource(Lease::with(['applications', 'amount_invoiced', 'property', 'unit', 'status'])->get());
    }

    public function store(StoreLeaseRequest $request)
    {
        $lease = Lease::create($request->all());
        $lease->applications()->sync($request->input('applications', []));

        return (new LeaseResource($lease))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lease $lease)
    {
        abort_if(Gate::denies('lease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeaseResource($lease->load(['applications', 'amount_invoiced', 'property', 'unit', 'status']));
    }

    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        $lease->update($request->all());
        $lease->applications()->sync($request->input('applications', []));

        return (new LeaseResource($lease))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lease $lease)
    {
        abort_if(Gate::denies('lease_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lease->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
