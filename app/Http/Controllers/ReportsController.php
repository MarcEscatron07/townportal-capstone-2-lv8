<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $modules = [
            'Networks' => 'Networks',
            'Computers' => 'Computers',
            'Peripherals' => 'Peripherals',
            'Products' => 'Products',
        ];

        return view('reports.index', compact('modules'));
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
