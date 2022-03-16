@extends('layouts.app')
@section('dashboard', 'active')
@section('content')
    
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
              <div class="breadcrumb-item">Breadcrumb</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                      <canvas id="balance-chart" height="75" width="319" style="display: block; width: 319px; height: 75px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Asset</h4>
                      </div>
                      <div class="card-body">
                        {{-- Rp. {{ number_format($totalaset,0,'.','.')}} --}}
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="balance-chart" height="75" width="319" style="display: block; width: 319px; height: 75px;" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Investor</h4>
                  </div>
                  <div class="card-body">
                    {{-- {{$totaluser}} Investor --}}
                  </div>
                </div>
              </div>
            </div>
        </div>
        
    </section>

    @push('script')
    <script src="{{ asset('admin_assets/assets/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/page/index.js') }}"></script>
    @endpush
@endsection