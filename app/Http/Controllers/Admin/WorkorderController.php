<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class WorkorderController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('workorder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Workorder::with(['vendor', 'vendor_spec', 'details'])->select(sprintf('%s.*', (new Workorder())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'workorder_show';
                $editGate = 'workorder_edit';
                $deleteGate = 'workorder_delete';
                $crudRoutePart = 'workorders';

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
            $table->addColumn('vendor_name', function ($row) {
                return $row->vendor ? $row->vendor->name : '';
            });

            $table->addColumn('vendor_spec_specialization', function ($row) {
                return $row->vendor_spec ? $row->vendor_spec->specialization : '';
            });

            $table->addColumn('details_specify', function ($row) {
                return $row->details ? $row->details->specify : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Workorder::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'vendor', 'vendor_spec', 'details']);

            return $table->make(true);
        }

        return view('admin.workorders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('workorder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendor_specs = Vendor::pluck('specialization', 'id')->prepend(trans('global.pleaseSelect'), '');

        $details = Maintenance::pluck('specify', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workorders.create', compact('vendors', 'vendor_specs', 'details'));
    }

    public function store(StoreWorkorderRequest $request)
    {
        $workorder = Workorder::create($request->all());

        return redirect()->route('admin.workorders.index');
    }

    public function edit(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendor_specs = Vendor::pluck('specialization', 'id')->prepend(trans('global.pleaseSelect'), '');

        $details = Maintenance::pluck('specify', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workorder->load('vendor', 'vendor_spec', 'details');

        return view('admin.workorders.edit', compact('vendors', 'vendor_specs', 'details', 'workorder'));
    }

    public function update(UpdateWorkorderRequest $request, Workorder $workorder)
    {
        $workorder->update($request->all());

        return redirect()->route('admin.workorders.index');
    }

    public function show(Workorder $workorder)
    {
        abort_if(Gate::denies('workorder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workorder->load('vendor', 'vendor_spec', 'details');

        return view('admin.workorders.show', compact('workorder'));
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
