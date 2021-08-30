@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workorder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workorders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="vendor_id">{{ trans('cruds.workorder.fields.vendor') }}</label>
                <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}" name="vendor_id" id="vendor_id" required>
                    @foreach($vendors as $id => $entry)
                        <option value="{{ $id }}" {{ old('vendor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workorder.fields.vendor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendor_spec_id">{{ trans('cruds.workorder.fields.vendor_spec') }}</label>
                <select class="form-control select2 {{ $errors->has('vendor_spec') ? 'is-invalid' : '' }}" name="vendor_spec_id" id="vendor_spec_id">
                    @foreach($vendor_specs as $id => $entry)
                        <option value="{{ $id }}" {{ old('vendor_spec_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendor_spec'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor_spec') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workorder.fields.vendor_spec_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="details_id">{{ trans('cruds.workorder.fields.details') }}</label>
                <select class="form-control select2 {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details_id" id="details_id" required>
                    @foreach($details as $id => $entry)
                        <option value="{{ $id }}" {{ old('details_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workorder.fields.details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.workorder.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Workorder::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Ongoing') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workorder.fields.status_helper') }}</span>
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