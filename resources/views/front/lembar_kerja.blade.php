<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>I Math | Lembar Kerja</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('img/logo.png')}}" rel="icon">
  <link href="{{ asset('img/logo.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('front/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizPage - v5.8.0
  * Template URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container-fluid">

      <div class="row justify-content-center align-items-center">
        <div class="col-xl-11 d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="{{ route('app.index') }}"><i class="bi bi-arrow-left"></i></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto " href="#hero">Home</a></li>
              <li><a class="nav-link scrollto" href="#about">About</a></li>
              <li><a class="nav-link scrollto" href="{{ route('logout')}}">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <h2>{{ Auth::user()->name }} - {{ Auth::user()->mahasiswa->nim }}</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-8 col-lg-8 col-sm-12 mb-2">
               
              @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Sukses!</strong> {{ session('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
          </div>
        </div>

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry">
              <h2 class="entry-title">
                <a href="{{ route('lembar.kerja.pengetahuan',$materi->id) }}">{{$materi->judul}}</a>
              </h2>
            </article><!-- End blog entry -->

            @if($jawaban == 'disabled' || $materi->latihan->status == 'draft')
              <article class="entry bg-secondary">
                <h2 class="entry-title">
                  <div class="row text-light">
                    <div class="col-10">
                      Latihan
                    </div>
                    <div class="col-2">
                      <i class="bi bi-lock-fill"></i>
                    </div>
                  </div>
                </h2>
              </article><!-- End blog entry -->
            @else
              <article class="entry">
                <h2 class="entry-title">
                  <a href="{{ route('lembar.kerja.latihan',$materi->latihan->id)}}">Latihan</a>
                </h2>
              </article><!-- End blog entry -->
            @endif


          </div><!-- End blog entries list -->

        </div>

        <div class="row">
          <div class="col-8">
            <div class="card shadow p-3 mb-5 bg-body rounded">
              <!-- ======= Contact Section ======= -->
              <section id="contact" class="section-bg">
                <div class="container" data-aos="fade-up">

                  <div class="section-header">
                    <h3>Nilai</h3>
                  </div>

                  <div class="row contact-info">

                    <div class="col-md-4">
                      <div class="contact-address">
                        <h3>Pengetahuan</h3>
                        <address>{{ $jawabanPengetahuan }}</address>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="contact-phone">
                        <h3>Latihan</h3>
                        <p>{{ $jawabanLatihan }}</p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="contact-email">
                        <h3>Rata-rata</h3>
                        <p>{{ $rata2 }}</p>
                      </div>
                    </div>

                  </div>

                </div>
              </section><!-- End Contact Section -->
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container">
      <div class="copyright">
        &copy; Develop By <strong>Hilfi Developer</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('front/assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('front/assets/js/main.js') }}"></script>

</body>

</html>