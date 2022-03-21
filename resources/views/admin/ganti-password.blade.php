@extends('layouts.app')
@section('content')
    
    <section class="section">
        <div class="section-header">
            <h1>Ganti Password</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Admin</a></div>
              <div class="breadcrumb-item">Ganti Password</div>
            </div>
        </div>

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

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                      <form action="{{ route('simpan.ganti.password') }}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label for="password" class="form-label">Password Baru</label>
                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="new-password" placeholder="Password Baru">
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                          <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password" id="password-confirm">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>

        
        
    </section>

    @push('script')
    <script src="{{ asset('admin_assets/assets/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/page/index.js') }}"></script>
    @endpush
@endsection