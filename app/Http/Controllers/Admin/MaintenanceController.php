<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('maintenance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Maintenance::with(['user', 'property', 'unit'])->select(sprintf('%s.*', (new Maintenance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'maintenance_show';
                $editGate = 'maintenance_edit';
                $deleteGate = 'maintenance_delete';
                $crudRoutePart = 'maintenances';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('property_name', function ($row) {
                return $row->property ? $row->property->name : '';
            });

            $table->addColumn('unit_name', function ($row) {
                return $row->unit ? $row->unit->name : '';
            });

            $table->editColumn('specify', function ($row) {
                return $row->specify ? $row->specify : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'property', 'unit']);

            return $table->make(true);
        }

        return view('admin.maintenances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('maintenance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.maintenances.create', compact('users', 'properties', 'units'));
    }

    public function store(StoreMaintenanceRequest $request)
    {
        $maintenance = Maintenance::create($request->all());

        return redirect()->route('admin.maintenances.index');
    }

    public function edit(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenance->load('user', 'property', 'unit');

        return view('admin.maintenances.edit', compact('users', 'properties', 'units', 'maintenance'));
    }

    public function update(UpdateMaintenanceRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->all());

        return redirect()->route('admin.maintenances.index');
    }

    public function show(Maintenance $maintenance)
    {
        abort_if(Gate::denies('maintenance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenance->load('user', 'property', 'unit');

        return view('admin.maintenances.show', compact('maintenance'));
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
