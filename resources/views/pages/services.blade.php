{{-- @extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1>
        @if(count($services) > 0)
            <ul class="list-group">
                @foreach ($services as $services)
                    <li class="list-group-item">{{$services}}</li>
                @endforeach
            </ul>
        @endif
  @endsection --}}

  <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>{{$title}}</h1>
                    @if(count($services) > 0)
                        <ul class="list-group">
                            @foreach ($services as $services)
                                <li class="list-group-item">{{$services}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>