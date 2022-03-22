@extends('layouts.app')
@section('latihan', 'active')
@section('content')
    
@push('style')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.css') }}">
@endpush

<section class="section">
    <div class="section-header">
        <h1>Edit Latihan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a href="#">Admin</a></div>
          <div class="breadcrumb-item"><a href="{{ route('latihan.index') }}">Manjemen Latihan</a></div>
          <div class="breadcrumb-item">Edit</div>
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

    @if($latihan->materi->tgl_aktif >= \Carbon\Carbon::now()->addDays(1)->format('Y-m-d'))
      <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
              <div class="card-body">
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
                <form action="{{ route('latihan.update',$latihan->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf @method('PUT')
                  <input type="hidden" name="latihan_id" value="{{ $latihan->id }}">
                  <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Pilih Materi</label>
                      <div class="col-sm-12 col-md-10">
                        <select name="materi_id" class="form-control" id="" required>
                              <option value="{{$latihan->materi_id}}" selected>{{$latihan->materi->judul}}</option>
                        </select>
                      </div>
                  </div>
                  
                  

                  <h4>Soal Latihan</h4>
                  <hr>
                  <div class="mb-3">
                      <button class="btn btn-primary" type="button">Tambah</button>
                  </div>
                  
                  @foreach ($soals->where('latihan_id',$latihan->id) as $soal)
                      <div class="form-group row mb-4 control-group increment">
                          <div class="col-sm-12 col-md-8">
                              <textarea class="w-100" required name="soal[]" id="" cols="30" rows="3" >{{$soal->soal}}</textarea>
                          </div>
                          <div class="col-sm-12 col-md-2">
                              <input type="number" required class="form-control" max="100" maxlength="3" name="bobot[]" value="{{$soal->bobot}}">
                              <p class="text-center">Bobot Nilai Maksimal</p>
                          </div>
                          <div class="col-sm-12 col-md-2 text-center">
                            <button class="btn btn-danger" type="button">Hapus</button>
                          </div>
                      </div>
                    
                  @endforeach

                  <div class="plus"></div>

                  <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Status</label>
                      <div class="col-sm-12 col-md-10">
                        <select name="status" class="form-control" id="" required>
                            <option {{ $latihan->status == 'publikasi' ? 'selected':'' }} value="publikasi">Publikasi</option>
                            <option {{ $latihan->status == 'publikasi' ? '':'selected' }} value="draft">Draft</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row mb-4">
                      <div class="col-sm-12 col-md-12">
                          <button type="submit" class="btn btn-warning btn-sm w-100">Simpan</button>
                      </div>
                  </div>
                </form> 
                  
                  
                
                <div class="clone d-none">
                  {{-- CLONE --}}
                  <div class="form-group row mb-4 control-group">
                      <div class="col-sm-12 col-md-8">
                          <textarea class="w-100" required name="soal[]" id="" cols="30" rows="3"></textarea>
                      </div>
                      <div class="col-sm-12 col-md-2">
                          <input type="number" required class="form-control" max="100" maxlength="3" name="bobot[]" >
                          <p class="text-center">Bobot Nilai Maksimal</p>
                      </div>
                      <div class="col-sm-12 col-md-2 text-center">
                          <button class="btn btn-danger" type="button">Hapus</button>
                      </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
      </div>
    @else
      <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
              <div class="card-body">
                  <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Pilih Materi</label>
                      <div class="col-sm-12 col-md-10">
                        <select name="materi_id" class="form-control" id="" required>
                              <option selected>{{$latihan->materi->judul}}</option>
                        </select>
                      </div>
                  </div>
                  
                  

                  <h4>Soal Latihan</h4>
                  <hr>
                  
                  @foreach ($soals->where('latihan_id',$latihan->id) as $soal)
                      <div class="form-group row mb-4 control-group increment">
                          <div class="col-sm-12 col-md-8">
                              <textarea class="w-100" disabled name="soal[]" id="" cols="30" rows="3" >{{$soal->soal}}</textarea>
                          </div>
                          <div class="col-sm-12 col-md-2">
                              <input type="number" disabled class="form-control" max="100" maxlength="3" name="bobot[]" value="{{$soal->bobot}}">
                              <p class="text-center">Bobot Nilai Maksimal</p>
                          </div>
                      </div>
                    
                  @endforeach

                  <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Status</label>
                      <div class="col-sm-12 col-md-10">
                        <select name="status" class="form-control" id="" disabled>
                          <option>{{ $latihan->status }}</option>
                        </select>
                      </div>
                  </div>
              </div>
              </div>
            </div>
          </div>
      </div>
    @endif

    
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

      $(".btn-primary").click(function(){ 
          var html = $(".clone").html();
          $(".plus").after(html);
          $( "#simpanBaru" ).removeClass( "d-none" );
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>

@endpush
@endsection