@extends('layouts.user')

@section('content')
  
<section class="container">
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
                {{ Auth::user()->name }}
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
            <div class="col-md-12">

              <div class="text-center mb-4" style="color: red">
                <h5 class="">{{$materi->judul}}</h5>
              </div>
              <a href="{{ route('studi-kasus.show',$materi->id)}}" style="text-decoration: none;">
                <div class="card imath-btn-color w-100 my-2">
                    <div class="card-body">
                    <div class="row text-white text-center">
                        <div class="col-12 text-center text-nowrap h-100">
                        Lembar Kerja
                        </div>
                    </div>
                    </div>
                </div>
              </a>

              <a href="{{ route('latihan-ongoing.show',$materi->latihan->id)}}" style="text-decoration: none; ">
                <div class="card imath-btn-color w-100 my-2">
                    <div class="card-body">
                    <div class="row text-white text-center">
                        <div class="col-12 text-center text-nowrap h-100">
                        Latihan
                        </div>
                    </div>
                    </div>
                </div>
              </a>

              <div class="card imath-btn-color w-100 mt-2 mb-4">
                <div class="card-body">
                  <div class="row text-white text-center">
                    <div class="col-12 text-center text-nowrap h-100">
                      <div class="row">
                        <div class="col-md-12 text-white">
                          Hasil
                        </div>
                        <div class="col-md-7 text-end">Nilai Pengetahuan :</div>
                        <div class="col-md-5 text-start">90</div>
                        <div class="col-md-7 text-end">Nilai Latihan :</div>
                        <div class="col-md-5 text-start">20</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card imath-btn-gradient w-100">
                <div class="card-body">
                  <div class="row text-white text-center">
                    <div class="col-12 text-center text-nowrap h-100">
                      <div class="row">

                        <div class="col-md-7 text-end">Nilai Rata - Rata :</div>
                        <div class="col-md-5 text-start"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>



@endsection