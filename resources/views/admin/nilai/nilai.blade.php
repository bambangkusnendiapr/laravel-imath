@extends('layouts.app')
@section('nilai', 'active')
@section('content')
    
@push('style')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

<section class="section">
    <div class="section-header">
        <h1>Manajemen Nilai</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Admin</a></div>
          <div class="breadcrumb-item">Manajemen Nilai</div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-12 mb-2">
        @if (session()->has('success'))    
            <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                <span>×</span>
                </button>
                {{ session('success')}}
            </div>
            </div>
        @endif
      </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="card">
            <div class="card-header">
             <a href="{{ route('materi.create')}}" class="btn btn-warning btn-sm"> <span data-feather="plus" style="width: 15px;"></span> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                      <thead>
                        <tr>
                          <th class="text-center" style="width:35px;" colspan="1">No</th>
                          <th>Judul</th>
                          <th>Status</th>
                          <th>Tanggal</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>lembar</td>
                          <td>aktif</td>
                          <td>11-11-2022</td>
                          <td>edit | hapus</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
            </div>
          </div>
        </div>
    </div>

    
</section>

@push('script')
<!-- JS Libraies -->
<script src="{{ asset('admin_assets/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('admin_assets/assets/js/page/modules-datatables.js') }}"></script>

@endpush
@endsection