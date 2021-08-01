{{-- @extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1>Welcome To Laravel!</h1>
    <p>This is the laravel application for Rental Housing Management System</p>
    <p><a class="btn btn-primary btn-lg" href="/rental_housing/public/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/rental_housing/public/register" role="button">Register</a></p>
</div>
@endsection --}}
   
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Welcome To Laravel!</h1>
                    <p>This is the laravel application for Rental Housing Management System</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
