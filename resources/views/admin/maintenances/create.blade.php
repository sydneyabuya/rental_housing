@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.maintenance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.maintenances.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.maintenance.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintenance.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="property_id">{{ trans('cruds.maintenance.fields.property') }}</label>
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
                <span class="help-block">{{ trans('cruds.maintenance.fields.property_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.maintenance.fields.unit') }}</label>
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
                <span class="help-block">{{ trans('cruds.maintenance.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specify">{{ trans('cruds.maintenance.fields.specify') }}</label>
                <textarea class="form-control {{ $errors->has('specify') ? 'is-invalid' : '' }}" name="specify" id="specify" required>{{ old('specify') }}</textarea>
                @if($errors->has('specify'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specify') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintenance.fields.specify_helper') }}</span>
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