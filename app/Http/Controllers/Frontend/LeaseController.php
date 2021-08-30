<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLeaseRequest;
use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdateLeaseRequest;
use App\Models\Application;
use App\Models\Invoice;
use App\Models\Lease;
use App\Models\Property;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        

        $leases = Lease::with(['applications', 'amount_invoiced', 'property', 'unit', 'status'])->get();

        return view('frontend.leases.index', compact('leases'));
    }

    public function create()
    {
        abort_if(Gate::denies('lease_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Application::pluck('name', 'id');

        $amount_invoiceds = Invoice::pluck('amount', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Unit::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.leases.create', compact('applications', 'amount_invoiceds', 'properties', 'units', 'statuses'));
    }

    public function store(StoreLeaseRequest $request)
    {
        $lease = Lease::create($request->all());
        $lease->applications()->sync($request->input('applications', []));

        return redirect()->route('frontend.leases.index');
    }

    public function edit(Lease $lease)
    {
        abort_if(Gate::denies('lease_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Application::pluck('name', 'id');

        $amount_invoiceds = Invoice::pluck('amount', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Unit::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lease->load('applications', 'amount_invoiced', 'property', 'unit', 'status');

        return view('frontend.leases.edit', compact('applications', 'amount_invoiceds', 'properties', 'units', 'statuses', 'lease'));
    }

    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        $lease->update($request->all());
        $lease->applications()->sync($request->input('applications', []));

        return redirect()->route('frontend.leases.index');
    }

    public function show(Lease $lease)
    {
        abort_if(Gate::denies('lease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lease->load('applications', 'amount_invoiced', 'property', 'unit', 'status');

        return view('frontend.leases.show', compact('lease'));
    }

    public function destroy(Lease $lease)
    {
        abort_if(Gate::denies('lease_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lease->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeaseRequest $request)
    {
        Lease::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
