<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\Product;
use App\Models\Computer;
use App\Models\Peripheral;
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
            case 'Computers':
                $data = Computer::get();
                return DataTables::of($data)
                    ->editColumn('network_id', function(Computer $computer){
                        return $computer->formattedNetwork();
                    })->editColumn('status_id', function(Computer $computer){
                        return $computer->formattedStatus();
                    })
                    ->make(true);
                break;
            case 'Peripherals':
                $data = Peripheral::get();
                return DataTables::of($data)
                    ->editColumn('computer_id', function(Peripheral $peripheral){
                        return $peripheral->formattedComputer();
                    })->editColumn('type_id', function(Peripheral $peripheral){
                        return $peripheral->formattedType();
                    })
                    ->make(true);
                break;
            case 'Products':
                $data = Product::get();
                return DataTables::of($data)
                    ->editColumn('category_id', function(Product $product){
                        return $product->formattedCategory();
                    })
                    ->make(true);
                break;
            default:
                $data = Network::get();
                return DataTables::of($data)
                    ->editColumn('provider_id', function(Network $network){
                        return $network->formattedProvider();
                    })
                    ->make(true);
                break;
        }
    }

    public function generate($module)
    {
        $genModule = 'Networks';
        switch($module) {
            case 'Computers':
                $genModule = $module;
                break;
            case 'Peripherals':
                $genModule = $module;
                break;
            case 'Products':
                $genModule = $module;
                break;
            default:
                $genModule = $module;
                break;
        }

        return 'Generate > module: '.$genModule;
    }
}
