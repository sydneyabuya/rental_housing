<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUnitRequest;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Property;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Unit::with(['property', 'property_units'])->select(sprintf('%s.*', (new Unit())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'unit_show';
                $editGate = 'unit_edit';
                $deleteGate = 'unit_delete';
                $crudRoutePart = 'units';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('property_name', function ($row) {
                return $row->property ? $row->property->name : '';
            });

            $table->editColumn('property.address', function ($row) {
                return $row->property ? (is_string($row->property) ? $row->property : $row->property->address) : '';
            });
            $table->editColumn('rent', function ($row) {
                return $row->rent ? $row->rent : '';
            });
            $table->editColumn('property_unit', function ($row) {
                $labels = [];
                foreach ($row->property_units as $property_unit) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $property_unit->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Unit::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'property', 'property_unit']);

            return $table->make(true);
        }

        return view('admin.units.index');
    }

    public function create()
    {
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_units = Property::pluck('name', 'id');

        return view('admin.units.create', compact('properties', 'property_units'));
    }

    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->all());
        $unit->property_units()->sync($request->input('property_units', []));

        return redirect()->route('admin.units.index');
    }

    public function edit(Unit $unit)
    {
        abort_if(Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $property_units = Property::pluck('name', 'id');

        $unit->load('property', 'property_units');

        return view('admin.units.edit', compact('properties', 'property_units', 'unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        $unit->property_units()->sync($request->input('property_units', []));

        return redirect()->route('admin.units.index');
    }

    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->load('property', 'property_units', 'statusLeases');

        return view('admin.units.show', compact('unit'));
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
