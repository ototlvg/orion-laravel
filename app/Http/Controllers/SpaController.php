<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index()
    {
        return view('prueba');
    }

    public function admin()
    {
        return view('admin');
    }
}
