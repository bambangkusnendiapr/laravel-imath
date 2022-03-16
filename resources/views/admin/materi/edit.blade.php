@extends('layouts.app')
@section('content')
    
@push('style')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.css') }}">
@endpush

<section class="section">
    <div class="section-header">
        <h1>Tambah Materi</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Tambah Materi</a></div>
          <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
          <div class="breadcrumb-item">Breadcrumb</div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-12 mb-2">
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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
              <form action="{{ route('materi.update',$materi->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Judul</label>
                    <div class="col-sm-12 col-md-10">
                      <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" autofocus value="{{ old('judul',$materi->judul)}}" placeholder="isi judul materi...">
                    </div>
                    
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Tanggal Aktif</label>
                    <div class="col-sm-12 col-md-10">
                      <input type="date" name="tgl_aktif" class="form-control @error('tgl_aktif') is-invalid @enderror" autofocus value="{{ old('tgl_aktif',$materi->tgl_aktif)}}">
                    </div>
                    
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Content</label>
                    <div class="col-sm-12 col-md-10">
                      <textarea name="isi_materi" class="summernote @error('isi_materi') is-invalid @enderror" autofocus value="{{ old('isi_materi')}}">{!!$materi->isi_materi!!}</textarea>
                    </div>
                    
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Status</label>
                    <div class="col-sm-12 col-md-10">
                      <select name="status" class="form-control" id="" required>
                          @if($materi->status == 'publikasi' || $materi->status == 'draft' )
                          <option value="{{$materi->status}}" selected>{{$materi->status}}</option>
                          <option value="draft">draft</option>
                          <option value="publikasi">publikasi</option>
                          @endif
                      </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"></label>
                    <div class="col-sm-12 col-md-10">
                        <button type="submit" class="btn btn-warning btn-sm w-100">Update</button>
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
<script src="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('admin_assets/assets/js/page/modules-datatables.js') }}"></script>

<script>
    $(".summernote").summernote({
       dialogsInBody: true,
      minHeight: 250,
    });
</script>

@endpush
@endsection