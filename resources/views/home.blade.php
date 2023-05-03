@inject('network','App\Models\Network')
@inject('computer','App\Models\Computer')

@extends('layouts.app')

@section('title', 'Home')

@section('home-active','active')

@section('header')
<div class="container page-header">
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
<div class="container page-content shadow-sm p-3">
    <div class="row">
        <div class="col-lg-8 my-3">
            <div class="w-100 d-flex">
                <span class="border-theme-bot fw-bold">
                    Networks added by Month
                </span>
            </div>
            <canvas id="chartNetworksByMonth"></canvas>
        </div>
        <div class="col-lg-4 my-3">
            <div class="w-100 d-flex">
                <span class="border-theme-bot fw-bold">
                    Networks by Provider
                </span>
            </div>
            <canvas id="chartNetworksByProvider"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 my-3">
            <div class="w-100 d-flex">
                <span class="border-theme-bot fw-bold">
                    Computers by Status
                </span>
            </div>
            <canvas id="chartComputersByStatus"></canvas>
        </div>
        <div class="col-lg-8 my-3">
            <div class="w-100 d-flex">
                <span class="border-theme-bot fw-bold">
                    Computers added by Month
                </span>
            </div>
            <canvas id="chartComputersByMonth"></canvas>
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
    </script>

    <script src="{{ asset('js/home-chart.js') }}"></script>
@endsection
