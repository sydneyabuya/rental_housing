@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.lease.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.leases.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lease->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.application') }}
                                    </th>
                                    <td>
                                        @foreach($lease->applications as $key => $application)
                                            <span class="label label-info">{{ $application->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.amount_invoiced') }}
                                    </th>
                                    <td>
                                        {{ $lease->amount_invoiced->amount ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.property') }}
                                    </th>
                                    <td>
                                        {{ $lease->property->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.unit') }}
                                    </th>
                                    <td>
                                        {{ $lease->unit->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.paid') }}
                                    </th>
                                    <td>
                                        {{ $lease->paid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.paid_at') }}
                                    </th>
                                    <td>
                                        {{ $lease->paid_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lease.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $lease->status->status ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.leases.index') }}">
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