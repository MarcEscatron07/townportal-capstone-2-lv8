<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate()
    {
        return null;
    }

    public function data()
    {
        return null;
    }
}
