@extends('layouts.app')
@section('dashboard', 'active')
@section('content')
    
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Admin</a></div>
              <div class="breadcrumb-item">Dashboard</div>
            </div>
        </div>

        
        
    </section>

    @push('script')
    <script src="{{ asset('admin_assets/assets/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/page/index.js') }}"></script>
    @endpush
@endsection