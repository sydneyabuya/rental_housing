@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.property.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.id') }}
                        </th>
                        <td>
                            {{ $property->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.name') }}
                        </th>
                        <td>
                            {{ $property->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.address') }}
                        </th>
                        <td>
                            {{ $property->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection