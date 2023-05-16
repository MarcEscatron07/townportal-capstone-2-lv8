<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Network;
use App\Models\Product;
use App\Models\Computer;
use App\Models\Peripheral;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportsController extends Controller
{
    public function index($module)
    {
        $modules = config('global.modules') ?? ['Networks'];
        $columns = config('global.columns');
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
                break;
            case 'Peripherals':
                $data = Peripheral::get();
                break;
            case 'Products':
                $data = Product::get();
                break;
            default:
                $data = Network::get();
                break;
        }
        $this->export($data, $module);
    }

    private function export($data, $module) {
        switch($module) {
            case 'Computers':
                $spreadsheet = IOFactory::load(public_path("spreadsheets/townportal-computers.xlsx"));
                break;
            case 'Peripherals':
                $spreadsheet = IOFactory::load(public_path("spreadsheets/townportal-peripherals.xlsx"));
                break;
            case 'Products':
                $spreadsheet = IOFactory::load(public_path("spreadsheets/townportal-products.xlsx"));
                break;
            default:
                $spreadsheet = IOFactory::load(public_path("spreadsheets/townportal-networks.xlsx"));
                break;
        }
        $sheet = $spreadsheet->getActiveSheet();
        $index = 11;
        $ctr = 1;

        foreach ($data as $d){
            switch($module) {
                case 'Computers':
                    $sheet->setCellValue('A'.$index, $ctr);
                    $sheet->setCellValue('B'.$index, $d->formattedNetwork());
                    $sheet->setCellValue('C'.$index, $d->formattedStatus());
                    $sheet->setCellValue('D'.$index, $d->name);
                    $sheet->setCellValue('E'.$index, $d->remarks);
                    break;
                case 'Peripherals':
                    $sheet->setCellValue('A'.$index, $ctr);
                    $sheet->setCellValue('B'.$index, $d->formattedComputer());
                    $sheet->setCellValue('C'.$index, $d->formattedType());
                    $sheet->setCellValue('D'.$index, $d->name);
                    $sheet->setCellValue('E'.$index, $d->brand);
                    $sheet->setCellValue('F'.$index, $d->model);
                    $sheet->setCellValue('G'.$index, $d->serial_number);
                    $sheet->setCellValue('H'.$index, $d->cost);
                    $sheet->setCellValue('I'.$index, $d->remarks);
                    break;
                case 'Products':
                    $sheet->setCellValue('A'.$index, $ctr);
                    $sheet->setCellValue('B'.$index, $d->formattedCategory());
                    $sheet->setCellValue('C'.$index, $d->name);
                    $sheet->setCellValue('D'.$index, $d->stock);
                    $sheet->setCellValue('E'.$index, $d->cost);
                    $sheet->setCellValue('F'.$index, $d->remarks);
                    break;
                default:
                    $sheet->setCellValue('A'.$index, $ctr);
                    $sheet->setCellValue('B'.$index, $d->formattedProvider());
                    $sheet->setCellValue('C'.$index, $d->name);
                    $sheet->setCellValue('D'.$index, $d->cost);
                    $sheet->setCellValue('E'.$index, $d->remarks);
                    break;
            }

            $index++;
            $ctr++;
        }
        $index--;

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

        $sheet->getStyle("A11:E{$index}")->getFont()->setName('Arial');
        $sheet->getStyle("A11:E{$index}")->getFont()->setSize(8);
        $sheet->getStyle("A11:E{$index}")->applyFromArray($borderStyle);
        $sheet->getStyle("B11:B{$index}")->getAlignment()->applyFromArray($verticalStyle);
        $sheet->getStyle("C11:C{$index}")->getAlignment()->applyFromArray($verticalStyle);
        $sheet->getStyle("D11:D{$index}")->getAlignment()->applyFromArray($verticalStyle);
        $sheet->getStyle("E11:E{$index}")->getAlignment()->applyFromArray($verticalStyle);

        switch($module) {
            case 'Peripherals':
                $sheet->getStyle("F11:F{$index}")->applyFromArray($borderStyle);
                $sheet->getStyle("F11:F{$index}")->getAlignment()->applyFromArray($verticalStyle);
                $sheet->getStyle("G11:G{$index}")->applyFromArray($borderStyle);
                $sheet->getStyle("G11:G{$index}")->getAlignment()->applyFromArray($verticalStyle);
                $sheet->getStyle("H11:H{$index}")->applyFromArray($borderStyle);
                $sheet->getStyle("H11:H{$index}")->getAlignment()->applyFromArray($verticalStyle);
                $sheet->getStyle("I11:I{$index}")->applyFromArray($borderStyle);
                $sheet->getStyle("I11:I{$index}")->getAlignment()->applyFromArray($verticalStyle);
                break;
            case 'Products':
                $sheet->getStyle("F11:F{$index}")->applyFromArray($borderStyle);
                $sheet->getStyle("F11:F{$index}")->getAlignment()->applyFromArray($verticalStyle);
                break;
        }

        $writer = new Xlsx($spreadsheet);
        $today = Carbon::now()->format('F d, Y') ?? null;
        $uid = $today ? '-'.$today : '';
        $filename = "Town_Portal_{$module}{$uid}";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
