<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers\Frontend;

class HomeController
{
    
    public function index()
    {
        return view('frontend.home');
    }
}
