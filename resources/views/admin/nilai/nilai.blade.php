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
          <div class="breadcrumb-item active"><a href="#">Laporan Mahasiswa</a></div>
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
        @if (session()->has('error'))    
            <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                <span>×</span>
                </button>
                {{ session('error')}}
            </div>
            </div>
        @endif
      </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="card">
            <div class="card-body">
            <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('nilai.index') }}">
                            <div class="form-group row">
                                <div class="col-6">
                                    <select name="materi" required class="form-control" id="">
                                        <option value="">Pilih Lembar Kerja</option>
                                        @foreach($materi as $data)
                                        <option {{ request('materi') == $data->id ? 'selected':'' }} value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success">Lihat Mahasiswa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="table-1">
                      <thead>
                        <tr>
                          <th class="text-center" style="width:35px;" colspan="1">No</th>
                          <th>NIM</th>
                          <th>Nama</th>
                          <th>Tanggal</th>
                          <th>Status</th>
                          <th>Pengetahuan</th>
                          <th>Latihan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($jawaban != null)
                        @foreach($jawaban as $data)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data->user->mahasiswa->nim }}</td>
                          <td>{{ $data->user->name }} <a href="{{ route('nilaiShow', ['idUser'=>$data->user->id, 'idMateri'=>request('materi')]) }}" class="badge badge-success float-right">nilai</a></td>
                          <td>{{ $data->created_at }}</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                          
                        @endforeach
                        @endif
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