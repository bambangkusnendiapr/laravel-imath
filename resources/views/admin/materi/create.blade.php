@extends('layouts.app')
@section('lembar-kerja', 'active')
@section('content')
    
@push('style')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.css') }}">
@endpush

<section class="section">
    <div class="section-header">
        <h1>Tambah Lembar Kerja</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Admin</a></div>
          <div class="breadcrumb-item"><a href="{{ route('materi.index') }}">Lembar Kerja</a></div>
          <div class="breadcrumb-item">Tambah Lembar Kerja</div>
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
            @if (count($errors) > 0)
              <div class="card-header">
                    <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
              </div>
              @endif
            <div class="card-body">
              <form action="{{ route('materi.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Judul</label>
                    <div class="col-sm-12 col-md-10">
                      <input type="text" name="judul" required class="form-control @error('judul') is-invalid @enderror" autofocus value="{{ old('judul')}}" placeholder="isi judul materi...">
                    </div>
                    
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Tanggal Aktif</label>
                    <div class="col-sm-12 col-md-10">
                      <input type="date" required name="tgl_aktif" class="form-control @error('tgl_aktif') is-invalid @enderror" autofocus value="{{ old('tgl_aktif')}}">
                    </div>
                    
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Content</label>
                    <div class="col-sm-12 col-md-10">
                      <textarea name="isi_materi" required class="summernote @error('isi_materi') is-invalid @enderror" autofocus value="{{ old('isi_materi')}}"></textarea>
                    </div>
                    
                </div>
                

                <hr>
                <h4>Lembar Pengetahuan</h4>
                <div class="form-group row mb-4 control-group increment">
                    <div class="col-sm-12 col-md-8">
                        <textarea class="form-control w-100" required name="isi[]" id="" cols="30" rows="5" style="min-height:80px;" ></textarea>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <input type="number" required class="form-control" max="100" maxlength="3" name="bobot[]" >
                        <p class="text-center">Bobot Nilai Maksimal</p>
                    </div>
                    <div class="col-sm-12 col-md-2 text-center">
                        <button class="btn btn-primary tambah" type="button">Tambah</button>
                    </div>
                </div>

                <hr>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Status</label>
                    <div class="col-sm-12 col-md-10">
                      <select name="status" class="form-control" id="">
                          <option value="publikasi">Publikasi</option>
                          <option value="draft">Draft</option>
                      </select>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"></label>
                    <div class="col-sm-12 col-md-10">
                        <button type="submit" class="btn btn-warning btn-sm w-100">Publish</button>
                    </div>
                </div>
              </form>

              <div class="clone d-none">
                  <div class="form-group row mb-4 control-group">
                      <div class="col-sm-12 col-md-8">
                          <textarea class="w-100 form-control" required height="20px" name="isi[]" id="" cols="30" rows="3" style="min-height:80px;"></textarea>
                      </div>
                      <div class="col-sm-12 col-md-2">
                          <input type="number" required class="form-control" max="100" maxlength="3" name="bobot[]" >
                          <p class="text-center">Bobot Nilai Maksimal</p>
                      </div>
                      <div class="col-sm-12 col-md-2 text-center">
                          <button class="btn btn-danger hapus" type="button">Hapus</button>
                      </div>
                  </div>
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
<script src="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('admin_assets/assets/js/page/modules-datatables.js') }}"></script>

<script>
    $(".summernote").summernote({
       dialogsInBody: true,
      minHeight: 250,
    });
</script>

<script type="text/javascript">

    $(document).ready(function() {

      $(".tambah").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".hapus",function(){ 
          $(this).parents(".control-group").remove();
      });


    });

</script>

@endpush
@endsection