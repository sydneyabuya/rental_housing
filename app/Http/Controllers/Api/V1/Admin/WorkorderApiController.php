<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkorderRequest;
use App\Http\Requests\UpdateWorkorderRequest;
use App\Http\Resources\Admin\WorkorderResource;
use App\Models\Workorder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkorderApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workorder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkorderResource(Workorder::with(['vendor', 'vendor_spec', 'details'])->get());
    }

    public function store(StoreWorkorderRequest $request)
    {
        $workorder = Workorder::create($request->all());

        return (new WorkorderResource($workorder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkorderResource($workorder->load(['vendor', 'vendor_spec', 'details']));
    }

    public function update(UpdateWorkorderRequest $request, Workorder $workorder)
    {
        $workorder->update($request->all());

        return (new WorkorderResource($workorder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workorder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
