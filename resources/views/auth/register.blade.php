@extends('layouts.user')

@section('content')

<section class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="min-height:640px;">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-center">
                            <svg width="68" height="80" viewBox="0 0 68 100" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="67.0157" height="100" fill="url(#pattern0)" />
                                <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_44_61" transform="scale(0.0078125 0.0052356)" />
                                    </pattern>
                                    <image id="image0_44_61" width="128" height="191"
                                        xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>
                        </div>
                    </div>
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses</strong> {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session()->has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Upps!</strong> {{ session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Maaf!</strong> Ada kesalahan ketika sedang proses input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('register')}}" method="POST" class="text-sm daftar">
                        @csrf

                        <h5 class="text-center mb-3">DAFTAR</h5>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                autofocus value="{{ old('name')}}" id="floatingInput" placeholder="Arya"
                                autocomplete="off">
                            <label for="floatingInput">Nama</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nim" class="nim form-control @error('nim') is-invalid @enderror"
                                autofocus value="{{ old('nim')}}" id="floatingInput" placeholder="209910399"
                                autocomplete="off">
                            <label for="floatingInput">NPM</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="prodi" class="form-control @error('prodi') is-invalid @enderror"
                                autofocus value="{{ old('prodi')}}" id="floatingInput" placeholder="209910399"
                                autocomplete="off">
                            <label for="floatingInput">Prodi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input disabled type="email" name="email"
                                class="email form-control @error('email') is-invalid @enderror" autofocus
                                value="{{ old('email')}}" id="floatingInput" placeholder="name@example.com"
                                autocomplete="off">
                            <label for="floatingInput">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword"
                                placeholder="Password" autocomplete="off">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mt-4">
                            <button class="w-100 btn btn-md text-white mb-3" type="submit"
                                style="background-color: #F7941D; font-weight:700; text-transform: uppercase;">Daftar</button>
                        </div>
                    </form>
                    <div class="text-center">
                        Sudah Memiliki Akun? <a href="{{ route('login.view')}}" class="text-blue"> Login</a><br>
                        <a href="{{ url('/lupa_password') }}" style="color: #F7941D;">Lupa Password</a>
                    </div>
                    <div class="footer-daftar text-center">
                        <div class="d-flex flex-column">
                            <div class="">
                                <img src="{{ asset('img/logo.png')}}" alt="" width="60">
                            </div>
                            <div class="text-footer-logo">
                                <p>UNSIKA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('script-register')
<script>
    $('.nim').on('change', function() {
        let nim = $('.nim').val();
        $('.email').val(nim + '@student.unsika.ac.id');
    });

</script>
@endpush

@endsection