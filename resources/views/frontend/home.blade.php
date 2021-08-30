@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Auth::user()->name }}
                </div>

                <div class="container">
                    <div class="row">
                      <div class="col-sm-8">
                        {{ $applications->property->name ?? '' }}
                      </div>
                      <div class="col-sm-4">
                        {{ Auth::user()->name ?? '' }}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        {{ $applications->unit->name ?? '' }}
                      </div>
                      <div class="col-sm">
                        {{ $leases->amount_invoiced->amount ?? '' }}
                      </div>
                      <div class="col-sm">
                        {{ $leases->paid ?? '' }}
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection