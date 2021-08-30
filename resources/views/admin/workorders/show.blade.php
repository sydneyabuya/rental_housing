@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workorder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workorders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workorder.fields.id') }}
                        </th>
                        <td>
                            {{ $workorder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workorder.fields.vendor') }}
                        </th>
                        <td>
                            {{ $workorder->vendor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workorder.fields.vendor_spec') }}
                        </th>
                        <td>
                            {{ $workorder->vendor_spec->specialization ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workorder.fields.details') }}
                        </th>
                        <td>
                            {{ $workorder->details->specify ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workorder.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Workorder::STATUS_SELECT[$workorder->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workorders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection