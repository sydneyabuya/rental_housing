<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MpesaC2B;

class C2BController extends Controller
{
    public function index()
    {
        return view('admin.mpesa.c2b.index', [
            'data' => MpesaC2B::paginate(20),
        ]);
    }
}
