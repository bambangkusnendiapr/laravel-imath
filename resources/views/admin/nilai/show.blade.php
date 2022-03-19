@extends('layouts.app')
@section('nilai', 'active')
@section('content')
    
@push('style')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

<section class="section">
    <div class="section-header">
        <h1>Pemberian Nilai</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Laporan Mahasiswa</a></div>
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
                        <strong>Nama :</strong> {{ $user->name }}
                        <br>
                        <strong>NPM :</strong> {{ $user->mahasiswa->nim }}
                        <br>
                        <h5>{{ $materi->judul }}</h5>
                    </div>
                    <div class="col-md-6">
                      <form action="#">
                          <div class="form-group row">
                              <div class="col-6 offset-2">
                                  <select name="search" required class="form-control" id="">
                                      <option value="">Pilih Penilaian</option>
                                      <option {{ request('search') == 'pengetahuan' ? 'selected':'' }} value="pengetahuan">Pengetahuan</option>
                                      <option {{ request('search') == 'latihan' ? 'selected':'' }} value="latihan">Latihan</option>
                                  </select>
                              </div>
                              <div class="col-4">
                                  <button type="submit" class="btn btn-success">Pilih</button>
                              </div>
                          </div>
                      </form>
                    </div>
                </div>

                <hr>
                
                @if(request('search') == 'pengetahuan')
                  <form action="{{ route('nilai.store') }}" method="post">
                    @csrf
                @endif
                @if(request('search') == 'latihan')
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
                        @if(request('search') == 'pengetahuan')
                          @foreach($jawabanPengetahuan as $data)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <strong>Pertanyaan</strong>
                              <p>{{ $data->pengetahuan->isi }}</p>
                              <strong>Jawaban</strong>
                              <p>{{ $data->jawaban }}</p>
                            </td>
                            <td>{{ $data->pengetahuan->bobot }}</td>
                            <td>
                              <input type="hidden" name="idUser" value="{{ $user->id }}" class="form-control">
                              <input type="hidden" name="idMateri" value="{{ $materi->id }}" class="form-control">
                              <input type="hidden" name="id[]" value="{{ $data->id }}" class="form-control">
                              <input type="number" required name="nilai[]" value="{{ $data->nilai }}" class="form-control">
                            </td>
                          </tr>
                          @endforeach
                        @endif

                        @if(request('search') == 'latihan')
                          @foreach($jawabanLatihan as $data)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <strong>Pertanyaan</strong>
                              <p>{{ $data->soalLatihan->soal }}</p>
                              <strong>Jawaban</strong>
                              <p>{!! $data->jawaban !!}</p>
                            </td>
                            <td>{{ $data->soalLatihan->bobot }}</td>
                            <td>
                              <input type="hidden" name="idUser" value="{{ $user->id }}" class="form-control">
                              <input type="hidden" name="idMateri" value="{{ $materi->id }}" class="form-control">
                              <input type="hidden" name="id[]" value="{{ $data->id }}" class="form-control">
                              <input type="number" name="nilai[]" value="{{ $data->nilai }}" class="form-control">
                            </td>
                          </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                </div>
                <hr>
                @if(request('search') == 'pengetahuan' || request('search') == 'latihan')
                <div class="row">
                  <div class="col-4">
                    <p class="text-right">Skor Pengetahuan: <strong>{{ $jawabanPengetahuan->sum('nilai') }}</strong></p>
                  </div>
                  <div class="col-4">
                    <p class="text-center">Skor Latihan: <strong>{{ $jawabanLatihan->sum('nilai') }}</strong></p>
                  </div>
                  <div class="col-4">
                    <p>Skor Rata-rata: <strong>-</strong></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-success w-100">Simpan Nilai</button>
                  </div>
                </div>
                @endif
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