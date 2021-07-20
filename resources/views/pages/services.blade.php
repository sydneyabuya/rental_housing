@extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1>
        @if(count($services) > 0)
            <ul class="list-group">
                @foreach ($services as $services)
                    <li class="list-group-item">{{$services}}</li>
                @endforeach
            </ul>
        @endif
  @endsection
