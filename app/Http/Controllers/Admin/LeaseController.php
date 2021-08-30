<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class LeaseController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lease::with(['applications', 'amount_invoiced', 'property', 'unit', 'status'])->select(sprintf('%s.*', (new Lease())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lease_show';
                $editGate = 'lease_edit';
                $deleteGate = 'lease_delete';
                $crudRoutePart = 'leases';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('application', function ($row) {
                $labels = [];
                foreach ($row->applications as $application) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $application->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('amount_invoiced_amount', function ($row) {
                return $row->amount_invoiced ? $row->amount_invoiced->amount : '';
            });

            $table->addColumn('property_name', function ($row) {
                return $row->property ? $row->property->name : '';
            });

            $table->addColumn('unit_name', function ($row) {
                return $row->unit ? $row->unit->name : '';
            });

            $table->editColumn('paid', function ($row) {
                return $row->paid ? $row->paid : '';
            });

            $table->addColumn('status_status', function ($row) {
                return $row->status ? $row->status->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'application', 'amount_invoiced', 'property', 'unit', 'status']);

            return $table->make(true);
        }

        return view('admin.leases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lease_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Application::pluck('name', 'id');

        $amount_invoiceds = Invoice::pluck('amount', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Unit::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.leases.create', compact('applications', 'amount_invoiceds', 'properties', 'units', 'statuses'));
    }

    public function store(StoreLeaseRequest $request)
    {
        $lease = Lease::create($request->all());
        $lease->applications()->sync($request->input('applications', []));

        return redirect()->route('admin.leases.index');
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

        return view('admin.leases.edit', compact('applications', 'amount_invoiceds', 'properties', 'units', 'statuses', 'lease'));
    }

    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        $lease->update($request->all());
        $lease->applications()->sync($request->input('applications', []));

        return redirect()->route('admin.leases.index');
    }

    public function show(Lease $lease)
    {
        abort_if(Gate::denies('lease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lease->load('applications', 'amount_invoiced', 'property', 'unit', 'status');

        return view('admin.leases.show', compact('lease'));
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
