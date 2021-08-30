@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.unit.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.units.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.units.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection