@inject('network','App\Models\Network')
@inject('computer','App\Models\Computer')
@inject('peripheral','App\Models\Peripheral')
@inject('product','App\Models\Product')

@extends('layouts.app')

@section('title', 'Home')

@section('home-active','active')

@section('header')
<div class="container page-header mb-0">
    <div class="row">
        <div class="col-6">
            <h3><span class="header-title">Dashboard</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container p-3">
    <div class="row">
        <div class="col-lg-8 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Networks added by Month
                    </span>
                </div>
                <canvas id="chartNetworksByMonth"></canvas>
            </div>
        </div>
        <div class="col-lg-4 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Networks by Provider
                    </span>
                </div>
                <canvas id="chartNetworksByProvider"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Computers by Status
                    </span>
                </div>
                <canvas id="chartComputersByStatus"></canvas>
            </div>
        </div>
        <div class="col-lg-8 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Computers added by Month
                    </span>
                </div>
                <canvas id="chartComputersByMonth"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Peripherals added by Month
                    </span>
                </div>
                <canvas id="chartPeripheralsByMonth"></canvas>
            </div>
        </div>
        <div class="col-lg-4 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Peripherals by Type
                    </span>
                </div>
                <canvas id="chartPeripheralsByType"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Products by Category
                    </span>
                </div>
                <canvas id="chartProductsByCategory"></canvas>
            </div>
        </div>
        <div class="col-lg-8 my-3">
            <div class="home-chart shadow-sm">
                <div class="w-100 d-flex">
                    <span class="chart-label fw-bold">
                        Products added by Month
                    </span>
                </div>
                <canvas id="chartProductsByMonth"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('plugins/Chart.js/chart.js') }}"></script>
    <script src="{{ asset('plugins/Chart.js/plugins/chartjs-plugin-datalabels.js') }}"></script>

    <script>
        /* JS code for Networks */
        const countNetworksJAN = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('January')->month) }});
        const countNetworksFEB = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('February')->month) }});
        const countNetworksMAR = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('March')->month) }});
        const countNetworksAPR = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('April')->month) }});
        const countNetworksMAY = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('May')->month) }});
        const countNetworksJUN = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('June')->month) }});
        const countNetworksJUL = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('July')->month) }});
        const countNetworksAUG = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('August')->month) }});
        const countNetworksSEP = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('September')->month) }});
        const countNetworksOCT = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('October')->month) }});
        const countNetworksNOV = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('November')->month) }});
        const countNetworksDEC = parseInt({{ $network->getNetworksByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('December')->month) }});
        const maxCountNetworksMonth = Math.max(
            countNetworksJAN,
            countNetworksFEB,
            countNetworksMAR,
            countNetworksAPR,
            countNetworksMAY,
            countNetworksJUN,
            countNetworksJUL,
            countNetworksAUG,
            countNetworksSEP,
            countNetworksOCT,
            countNetworksNOV,
            countNetworksDEC
        );

        const countNetworksPLDT = parseInt({{ $network->getNetworksByProviderCount('PLDT') }});
        const countNetworksGlobe = parseInt({{ $network->getNetworksByProviderCount('Globe') }});
        const countNetworksDITO = parseInt({{ $network->getNetworksByProviderCount('DITO') }});
        const countNetworksConverge = parseInt({{ $network->getNetworksByProviderCount('Converge') }});
        const countNetworksStarlink = parseInt({{ $network->getNetworksByProviderCount('Starlink') }});
        const sumNetworksProvider = countNetworksPLDT + countNetworksGlobe + countNetworksDITO + countNetworksConverge + countNetworksStarlink;
        /* JS code for Networks */

        /* JS code for Computers */
        const countComputersAvailable = parseInt({{ $computer->getComputersByStatusCount('1') }});
        const countComputersInUse = parseInt({{ $computer->getComputersByStatusCount('2') }});
        const countComputersUnderMaintenance = parseInt({{ $computer->getComputersByStatusCount('3') }});
        const sumComputersStatus = countComputersAvailable + countComputersInUse + countComputersUnderMaintenance;

        const countComputersJAN = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('January')->month) }});
        const countComputersFEB = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('February')->month) }});
        const countComputersMAR = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('March')->month) }});
        const countComputersAPR = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('April')->month) }});
        const countComputersMAY = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('May')->month) }});
        const countComputersJUN = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('June')->month) }});
        const countComputersJUL = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('July')->month) }});
        const countComputersAUG = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('August')->month) }});
        const countComputersSEP = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('September')->month) }});
        const countComputersOCT = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('October')->month) }});
        const countComputersNOV = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('November')->month) }});
        const countComputersDEC = parseInt({{ $computer->getComputersByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('December')->month) }});
        const maxCountComputersMonth = Math.max(
            countComputersJAN,
            countComputersFEB,
            countComputersMAR,
            countComputersAPR,
            countComputersMAY,
            countComputersJUN,
            countComputersJUL,
            countComputersAUG,
            countComputersSEP,
            countComputersOCT,
            countComputersNOV,
            countComputersDEC
        );
        /* JS code for Computers */

        /* JS code for Peripherals */
        const countPeripheralsJAN = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('January')->month) }});
        const countPeripheralsFEB = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('February')->month) }});
        const countPeripheralsMAR = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('March')->month) }});
        const countPeripheralsAPR = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('April')->month) }});
        const countPeripheralsMAY = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('May')->month) }});
        const countPeripheralsJUN = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('June')->month) }});
        const countPeripheralsJUL = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('July')->month) }});
        const countPeripheralsAUG = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('August')->month) }});
        const countPeripheralsSEP = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('September')->month) }});
        const countPeripheralsOCT = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('October')->month) }});
        const countPeripheralsNOV = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('November')->month) }});
        const countPeripheralsDEC = parseInt({{ $peripheral->getPeripheralsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('December')->month) }});
        const maxCountPeripheralsMonth = Math.max(
            countPeripheralsJAN,
            countPeripheralsFEB,
            countPeripheralsMAR,
            countPeripheralsAPR,
            countPeripheralsMAY,
            countPeripheralsJUN,
            countPeripheralsJUL,
            countPeripheralsAUG,
            countPeripheralsSEP,
            countPeripheralsOCT,
            countPeripheralsNOV,
            countPeripheralsDEC
        );

        const countPeripheralsHeadphone = parseInt({{ $peripheral->getPeripheralsByTypeCount('1') }});
        const countPeripheralsKeyboard = parseInt({{ $peripheral->getPeripheralsByTypeCount('2') }});
        const countPeripheralsMonitor = parseInt({{ $peripheral->getPeripheralsByTypeCount('3') }});
        const countPeripheralsMouse = parseInt({{ $peripheral->getPeripheralsByTypeCount('4') }});
        const countPeripheralsWebcam = parseInt({{ $peripheral->getPeripheralsByTypeCount('5') }});
        const sumPeripheralsType = countPeripheralsHeadphone + countPeripheralsKeyboard + countPeripheralsMonitor + countPeripheralsMouse + countPeripheralsWebcam;
        /* JS code for Peripherals */

        /* JS code for Products */
        const countProductsFood = parseInt({{ $product->getProductsByCategoryCount('1') }});
        const countProductsDrinks = parseInt({{ $product->getProductsByCategoryCount('2') }});
        const sumProductsCategory = countProductsFood + countProductsDrinks;

        const countProductsJAN = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('January')->month) }});
        const countProductsFEB = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('February')->month) }});
        const countProductsMAR = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('March')->month) }});
        const countProductsAPR = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('April')->month) }});
        const countProductsMAY = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('May')->month) }});
        const countProductsJUN = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('June')->month) }});
        const countProductsJUL = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('July')->month) }});
        const countProductsAUG = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('August')->month) }});
        const countProductsSEP = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('September')->month) }});
        const countProductsOCT = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('October')->month) }});
        const countProductsNOV = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('November')->month) }});
        const countProductsDEC = parseInt({{ $product->getProductsByMonthCount(\Carbon\Carbon::now()->year, \Carbon\Carbon::parse('December')->month) }});
        const maxCountProductsMonth = Math.max(
            countProductsJAN,
            countProductsFEB,
            countProductsMAR,
            countProductsAPR,
            countProductsMAY,
            countProductsJUN,
            countProductsJUL,
            countProductsAUG,
            countProductsSEP,
            countProductsOCT,
            countProductsNOV,
            countProductsDEC
        );
        /* JS code for Products */
    </script>
@endsection
