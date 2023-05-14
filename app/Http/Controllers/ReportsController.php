<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Network;
use App\Models\Product;
use App\Models\Computer;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
                    ->editColumn('computer_id', function(Peripheral $deripheral){
                        return $deripheral->formattedComputer();
                    })->editColumn('type_id', function(Peripheral $deripheral){
                        return $deripheral->formattedType();
                    })
                    ->make(true);
                break;
            case 'Products':
                $data = Product::get();
                return DataTables::of($data)
                    ->editColumn('category_id', function(Product $droduct){
                        return $droduct->formattedCategory();
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
        switch($module) {
            case 'Computers':
                $data = Computer::get();
                $spreadsheet = IOFactory::load("spreadsheets\\townportal-computers.xlsx");
                $sheet = $spreadsheet->getActiveSheet();
                $index = 11;
                $ctr = 1;

                foreach ($data as $d){
                    $sheet->setCellValue('A'.$index, $ctr);
                    $sheet->setCellValue('B'.$index, $d->formattedNetwork());
                    $sheet->setCellValue('C'.$index, $d->formattedStatus());
                    $sheet->setCellValue('D'.$index, $d->name);
                    $sheet->setCellValue('E'.$index, $d->remarks);

                    $index++;
                    $ctr++;
                }
                $verticalStyle = [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => TRUE
                ];

                $borderStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $index--;

                $sheet->getStyle("A11:E{$index}")->getFont()->setName('Arial');
                $sheet->getStyle("A11:E{$index}")->getFont()->setSize(8);
                $sheet->getStyle("A11:E{$index}")->applyFromArray($borderStyle);
                $sheet->getStyle("B11:B{$index}")->getAlignment()->applyFromArray($verticalStyle);
                $sheet->getStyle("C11:C{$index}")->getAlignment()->applyFromArray($verticalStyle);
                $sheet->getStyle("D11:D{$index}")->getAlignment()->applyFromArray($verticalStyle);
                $sheet->getStyle("E11:E{$index}")->getAlignment()->applyFromArray($verticalStyle);

                $writer = new Xlsx($spreadsheet);
                $today = Carbon::now()->format('F d, Y') ?? null;
                $uid = $today ? '-'.$today : '';
                $filename = "Town_Portal_{$module}{$uid}";
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
                break;
            case 'Peripherals':
                break;
            case 'Products':
                break;
            default:
                break;
        }
    }
}
