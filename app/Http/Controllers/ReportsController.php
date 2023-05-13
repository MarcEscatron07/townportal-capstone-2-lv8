<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
                'provider_id' => 'Provider',
                'name' => 'Name',
                'cost' => 'Cost',
                'remarks' => 'Remarks',
            ],
            'Computers' => [
                'network_id' => 'Network',
                'status_id' => 'Status',
                'name' => 'Name',
                'remarks' => 'Remarks',
            ],
            'Peripherals' => [
                'computer_id' => 'Computer',
                'type_id' => 'Type',
                'name' => 'Name',
                'brand' => 'Brand',
                'model' => 'Model',
                'serial_number' => 'Serial No.',
                'cost' => 'Cost',
                'remarks' => 'Remarks',
            ],
            'Products' => [
                'category_id' => 'Category',
                'name' => 'Name',
                'stock' => 'Stock',
                'cost' => 'Cost',
                'remarks' => 'Remarks',
            ],
        ];
        $defModule = $module ?? $modules[0];

        return view('reports.index', compact('modules', 'columns', 'defModule'));
    }

    public function data($module)
    {
        switch($module) {
            case 'Networks':
            $data = Network::get();

            return DataTables::of($data)
                ->editColumn('provider_id', function(Network $network){
                    return $network->formattedProvider();
                })
                ->make(true);
                break;
            case 'Computers':
                break;
            case 'Peripherals':
                break;
            case 'Products':
                break;
        }

        return 'reports.data > module: '.$module;
    }

    public function generate()
    {
        return null;
    }
}
