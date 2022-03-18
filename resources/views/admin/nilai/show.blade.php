@extends('layouts.app')
@section('nilai', 'active')
@section('content')
    
@push('style')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

<section class="section">
    <div class="section-header">
        <h1>Pemberian Nilai {{ $mahasiswa->user->name }} - {{ $mahasiswa->nim }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Admin</a></div>
          <div class="breadcrumb-item active"><a href="{{ route('nilai.index') }}">Manajemen Nilai</a></div>
          <div class="breadcrumb-item">Pemberian Nilai</div>
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('nilai.show', $idMahasiswa) }}">
                            <div class="form-group row">
                                <div class="col-6">
                                    <select name="pengetahuan" required class="form-control" id="">
                                        <option value="">Pilih Lembar Kerja</option>
                                        @foreach($materi as $data)
                                            <option {{ request('pengetahuan') == $data->id ? 'selected':'' }} value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success">Nilai Pengetahuan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('nilai.show', $idMahasiswa) }}">
                            <div class="form-group row">
                                <div class="col-6 offset-2">
                                    <select name="latihan" class="form-control" id="">
                                        <option value="">Pilih Lembar Kerja</option>
                                        @foreach($materi as $data)
                                            <option {{ request('latihan') == $data->id ? 'selected':'' }} value="{{ $data->id }}">{{ $data->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success">Nilai Latihan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                @if(request('pengetahuan'))
                  <form action="{{ route('nilai.store') }}" method="post">
                    @csrf
                @endif
                @if(request('latihan'))
                  <form action="{{ route('nilai.latihan.store') }}" method="post">
                    @csrf
                @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                      <thead>
                        <tr>
                          <th class="text-center" style="width:35px;">No</th>
                          <th>Soal & Jawaban</th>
                          <th>Bobot</th>
                          <th>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(request('pengetahuan'))
                          @foreach($jawabanPengetahuan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    - <strong>Soal:</strong> {{ $data->pengetahuan->isi }}
                                    <br>
                                    - <strong>Jawaban:</strong> {{ $data->jawaban }}
                                </td>
                                <td>{{ $data->pengetahuan->bobot }}</td>
                                <td>
                                    <input type="hidden" name="id[]" value="{{ $data->id }}">
                                    <input type="number" required name="nilai[]" value="{{ $data->nilai }}" class="form-control">
                                </td>
                            </tr>
                          @endforeach
                      @endif
                      @if(request('latihan'))
                        @foreach($jawabanLatihan as $data)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                  - <strong>Soal:</strong> {{ $data->soalLatihan->soal }}
                                  <br>
                                  - <strong>Jawaban:</strong> {{ $data->jawaban }}
                              </td>
                              <td>{{ $data->soalLatihan->bobot }}</td>
                              <td>
                                  <input type="hidden" name="id[]" value="{{ $data->id }}">
                                  <input type="number" required name="nilai[]" value="{{ $data->nilai }}" class="form-control">
                              </td>
                          </tr>
                        @endforeach
                      @endif
                      </tbody>
                    </table>
                </div>
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-success w-100">Simpan Nilai</button>
                  </div>
                </div>
                </form>
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