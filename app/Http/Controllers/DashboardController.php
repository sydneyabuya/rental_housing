<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('tenant')) {
            return view('tenantdash');
        } elseif (Auth::user()->hasRole('propertymanager')) {
            return view('propertymanagerdash');
        } elseif (Auth::user()->hasRole('landlord')) {
            return view('dashboard');
        }
    }

    public function myprofile()
    {
        return view('myprofile');
    }

    public function postrequest()
    {
        return view('postrequest');
    }
}
