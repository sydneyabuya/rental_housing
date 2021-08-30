@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.unit.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="property_id">{{ trans('cruds.unit.fields.property') }}</label>
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
                <span class="help-block">{{ trans('cruds.unit.fields.property_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rent">{{ trans('cruds.unit.fields.rent') }}</label>
                <input class="form-control {{ $errors->has('rent') ? 'is-invalid' : '' }}" type="number" name="rent" id="rent" value="{{ old('rent', '') }}" step="0.01" required>
                @if($errors->has('rent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.rent_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="property_units">{{ trans('cruds.unit.fields.property_unit') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('property_units') ? 'is-invalid' : '' }}" name="property_units[]" id="property_units" multiple required>
                    @foreach($property_units as $id => $property_unit)
                        <option value="{{ $id }}" {{ in_array($id, old('property_units', [])) ? 'selected' : '' }}>{{ $property_unit }}</option>
                    @endforeach
                </select>
                @if($errors->has('property_units'))
                    <div class="invalid-feedback">
                        {{ $errors->first('property_units') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.property_unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.unit.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Unit::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Vacant') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.status_helper') }}</span>
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