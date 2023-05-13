<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index($module)
    {
        $modules = [
            'Networks',
            'Computers',
            'Peripherals',
            'Products',
        ];
        $columns = [
            'Networks' => [
                'Provider',
                'Name',
                'Cost',
                'Remarks',
            ],
            'Computers' => [
                'Network',
                'Status',
                'Name',
                'Remarks',
            ],
            'Peripherals' => [
                'Computer',
                'Type',
                'Name',
                'Brand',
                'Model',
                'Serial No.',
                'Cost',
                'Remarks',
            ],
            'Products' => [
                'Category',
                'Name',
                'Stock',
                'Cost',
                'Remarks',
            ],
        ];
        $defModule = $module ?? $modules[0];

        return view('reports.index', compact('modules', 'columns', 'defModule'));
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
