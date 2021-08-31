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
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/612db375d6e7610a49b2d1a1/1fed8a23h';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->