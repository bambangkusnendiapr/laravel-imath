@extends('layouts.user')

@section('content')
  

<section class="container ">
  <div class="row justify-content-center">
      <div class="col-md-4" >
        <div class="card-header imath-header-color">
          <div class="row text-start">
            <div class="col-4 pt-3">
              <a href="{{ route('summary.index')}}" style="text-decoration: none;">
                <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.33325 13L1.91904 11.5858L0.504825 13L1.91904 14.4142L3.33325 13ZM30.8333 15C31.9378 15 32.8333 14.1046 32.8333 13C32.8333 11.8954 31.9378 11 30.8333 11V15ZM12.919 0.585786L1.91904 11.5858L4.74747 14.4142L15.7475 3.41421L12.919 0.585786ZM1.91904 14.4142L12.919 25.4142L15.7475 22.5858L4.74747 11.5858L1.91904 14.4142ZM3.33325 15H30.8333V11H3.33325V15Z" fill="white"/>
                </svg>                
              </a>
            </div>
            <div class="col-4 text-center">
              <label class="text-white">Halo,</label>
              <label class="text-white">
                {{$user->name}}
              </label>
              <small class="text-white">NIM:123456</small>
            </div>
            <div class="col-4 text-end">
              <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M29 0C12.992 0 0 12.992 0 29C0 45.008 12.992 58 29 58C45.008 58 58 45.008 58 29C58 12.992 45.008 0 29 0ZM29 8.7C33.814 8.7 37.7 12.586 37.7 17.4C37.7 22.214 33.814 26.1 29 26.1C24.186 26.1 20.3 22.214 20.3 17.4C20.3 12.586 24.186 8.7 29 8.7ZM29 49.88C25.5544 49.88 22.1623 49.0273 19.1263 47.398C16.0903 45.7687 13.5047 43.4133 11.6 40.542C11.687 34.771 23.2 31.61 29 31.61C34.771 31.61 46.313 34.771 46.4 40.542C44.4953 43.4133 41.9097 45.7687 38.8737 47.398C35.8377 49.0273 32.4456 49.88 29 49.88Z"
                  fill="white" />
              </svg>
            </div>
          </div>
        </div>
        <div class="card-body imath-body-color" style="min-height: 650px;">
                @if (count($errors) > 0)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if (session()->has('error'))  
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>  
                @endif
                @if (session()->has('success'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
            <form action="{{ route('jawaban-latihan.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" value="{{ $materi_id }}">
                <div class="container">
                    @foreach ($soals->where('latihan_id',$latihan_id) as $soal)
                        <div class="row  mt-4">
                            <div class="col-sm-1">
                                <button class="btn btn-sm btn-danger">{{$loop->iteration}}</button>
                            </div>
                            <div class="col-sm-11">
                                <p> {{$soal->soal}}</p>
                                <div class="form-group">
                                  <input type="hidden" name="soal_id[]" value="{{$soal->id}}">
                                    <textarea class="form-control @error('jawaban') is-invalid @enderror " name="jawaban[]" autofocus value="{{ old('jawaban')}}" id="" cols="30" rows="5" required></textarea>
                                    <div class="mt-2">@error('jawaban'){{$message}}@enderror</div>
                                </div>
                                <div class="form-group">
                                  <input type="file" name="jawaban_image[]">
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <button type="submit" class="btn btn-danger btn-sm w-100">Kirim</button>
                    </div>
                </div>
            </form>

        </div>
      </div>
  </div>
</section>

@endsection
