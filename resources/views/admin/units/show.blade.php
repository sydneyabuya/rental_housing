@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.unit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.id') }}
                        </th>
                        <td>
                            {{ $unit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.name') }}
                        </th>
                        <td>
                            {{ $unit->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.property') }}
                        </th>
                        <td>
                            {{ $unit->property->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.rent') }}
                        </th>
                        <td>
                            {{ $unit->rent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.property_unit') }}
                        </th>
                        <td>
                            @foreach($unit->property_units as $key => $property_unit)
                                <span class="label label-info">{{ $property_unit->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Unit::STATUS_SELECT[$unit->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#status_leases" role="tab" data-toggle="tab">
                {{ trans('cruds.lease.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="status_leases">
            @includeIf('admin.units.relationships.statusLeases', ['leases' => $unit->statusLeases])
        </div>
    </div>
</div>

@endsection