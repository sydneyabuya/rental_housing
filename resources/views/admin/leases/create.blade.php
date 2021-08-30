@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lease.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.leases.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="applications">{{ trans('cruds.lease.fields.application') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('applications') ? 'is-invalid' : '' }}" name="applications[]" id="applications" multiple required>
                    @foreach($applications as $id => $application)
                        <option value="{{ $id }}" {{ in_array($id, old('applications', [])) ? 'selected' : '' }}>{{ $application }}</option>
                    @endforeach
                </select>
                @if($errors->has('applications'))
                    <div class="invalid-feedback">
                        {{ $errors->first('applications') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.application_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount_invoiced_id">{{ trans('cruds.lease.fields.amount_invoiced') }}</label>
                <select class="form-control select2 {{ $errors->has('amount_invoiced') ? 'is-invalid' : '' }}" name="amount_invoiced_id" id="amount_invoiced_id" required>
                    @foreach($amount_invoiceds as $id => $entry)
                        <option value="{{ $id }}" {{ old('amount_invoiced_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('amount_invoiced'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_invoiced') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.amount_invoiced_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="property_id">{{ trans('cruds.lease.fields.property') }}</label>
                <select class="form-control select2 {{ $errors->has('property') ? 'is-invalid' : '' }}" name="property_id" id="property_id" required>
                    @foreach($properties as $id => $entry)
                        <option value="{{ $id }}" {{ old('property_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('property'))
                    <div class="invalid-feedback">
                        {{ $errors->first('property') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.property_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.lease.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id" required>
                    @foreach($units as $id => $entry)
                        <option value="{{ $id }}" {{ old('unit_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paid">{{ trans('cruds.lease.fields.paid') }}</label>
                <input class="form-control {{ $errors->has('paid') ? 'is-invalid' : '' }}" type="number" name="paid" id="paid" value="{{ old('paid', '') }}" step="0.01">
                @if($errors->has('paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paid_at">{{ trans('cruds.lease.fields.paid_at') }}</label>
                <input class="form-control datetime {{ $errors->has('paid_at') ? 'is-invalid' : '' }}" type="text" name="paid_at" id="paid_at" value="{{ old('paid_at') }}">
                @if($errors->has('paid_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paid_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.paid_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.lease.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lease.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection