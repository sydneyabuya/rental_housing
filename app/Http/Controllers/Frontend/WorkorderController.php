<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkorderRequest;
use App\Http\Requests\StoreWorkorderRequest;
use App\Http\Requests\UpdateWorkorderRequest;
use App\Models\Maintenance;
use App\Models\Vendor;
use App\Models\Workorder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkorderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workorder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workorders = Workorder::with(['vendor', 'vendor_spec', 'details'])->get();

        return view('frontend.workorders.index', compact('workorders'));
    }

    public function create()
    {
        abort_if(Gate::denies('workorder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendor_specs = Vendor::pluck('specialization', 'id')->prepend(trans('global.pleaseSelect'), '');

        $details = Maintenance::pluck('specify', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.workorders.create', compact('vendors', 'vendor_specs', 'details'));
    }

    public function store(StoreWorkorderRequest $request)
    {
        $workorder = Workorder::create($request->all());

        return redirect()->route('frontend.workorders.index');
    }

    public function edit(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendor_specs = Vendor::pluck('specialization', 'id')->prepend(trans('global.pleaseSelect'), '');

        $details = Maintenance::pluck('specify', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workorder->load('vendor', 'vendor_spec', 'details');

        return view('frontend.workorders.edit', compact('vendors', 'vendor_specs', 'details', 'workorder'));
    }

    public function update(UpdateWorkorderRequest $request, Workorder $workorder)
    {
        $workorder->update($request->all());

        return redirect()->route('frontend.workorders.index');
    }

    public function show(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workorder->load('vendor', 'vendor_spec', 'details');

        return view('frontend.workorders.show', compact('workorder'));
    }

    public function destroy(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workorder->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkorderRequest $request)
    {
        Workorder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
