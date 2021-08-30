@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.invoice.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.invoices.update", [$invoice->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="tenant_id">{{ trans('cruds.invoice.fields.tenant') }}</label>
                            <select class="form-control select2" name="tenant_id" id="tenant_id" required>
                                @foreach($tenants as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('tenant_id') ? old('tenant_id') : $invoice->tenant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tenant'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tenant') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.tenant_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="billing_for">{{ trans('cruds.invoice.fields.billing_for') }}</label>
                            <input class="form-control" type="text" name="billing_for" id="billing_for" value="{{ old('billing_for', $invoice->billing_for) }}" required>
                            @if($errors->has('billing_for'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('billing_for') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.billing_for_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.invoice.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $invoice->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="due">{{ trans('cruds.invoice.fields.due') }}</label>
                            <input class="form-control datetime" type="text" name="due" id="due" value="{{ old('due', $invoice->due) }}" required>
                            @if($errors->has('due'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.due_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.invoice.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Invoice::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $invoice->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection