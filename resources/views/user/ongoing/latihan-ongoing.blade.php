@extends('layouts.user')



@section('content')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('admin_assets/assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.css') }}">
@endpush

@push('dashboard-mahasiswa')
<link href="{{ asset('user_assets/css/mahasiswa.css')}}" rel="stylesheet">
@endpush


<section class="container ">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card-header imath-header-color">
        <div class="row text-start">
          <div class="col-4 pt-3">
            <a href="{{ route('materi-ongoing.show',$materi_id) }}" style="text-decoration: none;">
              <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3.33325 13L1.91904 11.5858L0.504825 13L1.91904 14.4142L3.33325 13ZM30.8333 15C31.9378 15 32.8333 14.1046 32.8333 13C32.8333 11.8954 31.9378 11 30.8333 11V15ZM12.919 0.585786L1.91904 11.5858L4.74747 14.4142L15.7475 3.41421L12.919 0.585786ZM1.91904 14.4142L12.919 25.4142L15.7475 22.5858L4.74747 11.5858L1.91904 14.4142ZM3.33325 15H30.8333V11H3.33325V15Z"
                  fill="white" />
              </svg>
            </a>
          </div>
          <div class="col-4 text-center">
            <label class="text-white">Halo,</label><br>
            <label class="text-white">
            {{ Auth::user()->name }}
            </label><br>
            <small class="text-white">{{ Auth::user()->mahasiswa->nim }}</small>
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
      <div class="card-body imath-body-color bg-dashboard-latihan" style="min-height: 650px;">


        <div class="custom-pagination" data-count="1">
          <div class="listing-outer">
            <form action="{{ route('jawaban-latihan.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="materi_id" value="{{ $materi_id }}">
              <div class="item-listing">
                @php $iterasi = 0; $jumlah = $soals->where('latihan_id',$latihan_id)->count(); @endphp
                @foreach ($soals->where('latihan_id',$latihan_id) as $soal)
                  @php $iterasi++; @endphp
                
                <div class="item-single">
                  <div class="garis-fixed">
                    <div class="garis-latihan">
                    </div>
                    <div class="nomer">{{ $iterasi }}</div>
                    <div class="font">
                      <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="paragrap">
                      <h5 class="text-center" style="color: brown">Latihan {{ $iterasi }}</h5>
                      <p>{{$soal->soal}}</p>
                    </div>
                  </div>


                    <div class="form-group row mb-4">
                      <div class="col-sm-12 col-md-12">
                        <input type="hidden" name="soal_id[]" value="{{$soal->id}}">
                        <textarea name="jawaban[]" class="note" autofocus></textarea>
                      </div>
                    </div>
                    <div class="content-edit d-flex justify-content-between align-self-center">
                      <div class="edit">
                        <i class="fas fa-edit"></i>
                      </div>
                      <div class="atau">
                        <p>atau</p>
                      </div>
                      <div class="camera">
                        <i class="fas fa-camera"></i>
                      </div>
                    </div>


                    @if($iterasi == $jumlah)
                    <div class="text-center mt-5">
                      <button type="submit" style="border:none; background:none; width:70%; ">
                        <div class="card imath-btn-color w-100 my-2">
                          <div class="card-body">
                            <div class="row text-white">
                              <div class="col-12 text-center text-nowrap h-100">
                                Kirim Jawaban
                              </div>
                            </div>
                          </div>
                        </div>
                      </button>
                    </div>
                    @endif



                </div>
                @endforeach
              </div>
            </form>


            <div style="width: 40%; margin:0 auto;">
              <div class="item-pagination d-flex justify-content-between align-items-center">
                <div class="left">
                  <p class="prev"><a href="javaScript:void(0)" id="prevDealSlide"><i class="fas fa-caret-left"></i></a>
                  </p>
                </div>
                <div class="page">
                  <span class="page-count"></span>
                </div>
                <div class="right">
                  <p class="next"><a href="javaScript:void(0)" id="nextDealSlide"><i class="fas fa-caret-right"></i></a>
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@push('script')
<!-- JS Libraies -->
<script src="{{ asset('admin_assets/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/summernote/dist/summernote-bs4.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('admin_assets/assets/js/page/modules-datatables.js') }}"></script>

<script>
  $('#edit-materi').on('click', function () {
    $('.note').summernote('focus');
  });
  $(".note").summernote({
      dialogsInBody: true,
      minHeight: 250,
    });
    $(".custom-pagination").each(function () {
                var this_val = $(this);
                if ($('.custom-pagination').length > 0) {
                    var totalRows = this_val.find('.item-listing .item-single').length;
                    var pageSize = this_val.attr("data-count");
                    var noOfPage = totalRows / pageSize;
                    noOfPage = Math.ceil(noOfPage);
                    var noOfPageCount = noOfPage;

                    this_val.find('.total-page-count').remove();
                    this_val.find('.item-pagination .page-count').after('<span class="total-page-count"> / ' + noOfPageCount + '</span>');

                    for (var i = 1; i <= noOfPage; i++) {
                        if (i == 1) {
                            var classs = 'selected';
                        } else {
                            var classs = '';
                        }
                        this_val.find(".item-pagination .page-count").append('<b class=' + classs + '>' + i + '</b>');
                    }

                    var totalPagenum = this_val.find(".item-pagination .page-count b").length;
                    if (totalPagenum > 1) {
                        this_val.find(".item-pagination .page-count b").hide();
                        this_val.find('.prev').addClass('pagi-disabled');
                        for (var n = 1; n <= 1; n++) {
                            this_val.find(".item-pagination .page-count b:nth-child(" + n + ")").show();
                        }
                    }
                    else {
                        this_val.find(".prev").hide();
                        this_val.find(".next").hide();
                    }
                    this_val.find('.item-listing .item-single').hide();
                    for (var j = 1; j <= pageSize; j++) {
                        this_val.find(".item-listing .item-single:nth-child(" + j + ")").show();
                    }
                    displayevent($(this));
                }

                $(this).find('.next').on('click', function (ev) {
                    ev.preventDefault();
                    if ($(this_val).find("b.selected:last").nextAll('b').length > 1) {
                        $(this_val).find("b.selected").last().nextAll(':lt(1)').show();
                        $(this_val).find("b.selected").hide();
                        displayevent($(this_val));
                        $(this_val).find(".prev").removeClass('pagi-disabled');
                        $(this_val).find(".next").removeClass('pagi-disabled');
                    }
                    else {
                        $(this_val).find("b.selected").last().nextAll().show();
                        $(this_val).find("b.selected").hide();
                        displayevent($(this_val));
                        $(this_val).find(".prev").removeClass('pagi-disabled');
                        $(this_val).find(".next").addClass('pagi-disabled');
                    }
                    displayRows($(this_val));
                });

                $(this).find('.prev').on('click', function (ev) {
                    ev.preventDefault();
                    if ($(this_val).find("b.selected:first").prevAll('b').length > 1) {
                        $(this_val).find("b.selected").first().prevAll(':lt(1)').show();
                        $(this_val).find("b.selected").hide();
                        $(this_val).find(".prev").removeClass('pagi-disabled');
                        $(this_val).find(".next").removeClass('pagi-disabled');
                        displayevent($(this_val));
                    }
                    else {
                        $(this_val).find("b.selected").first().prevAll().show();
                        $(this_val).find("b.selected").hide();
                        $(this_val).find(".prev").addClass('pagi-disabled');
                        $(this_val).find(".next").removeClass('pagi-disabled');
                        displayevent($(this_val));
                    }
                    displayRows($(this_val));
                });

            })


/* PAGINATION FUNCTIONS */

function displayRows(this_current) {
    var currentPage = $(this_current).find('b.selected').text();
    $(this_current).find(".item-listing .item-single").hide();
    var pageSize = $(this_current).attr("data-count");
    for (var k = (currentPage * pageSize) - (pageSize - 1) ; k <= (currentPage * pageSize) ; k++) {
        $(this_current).find(".item-listing .item-single:nth-child(" + k + ")").show();
    }

    var customPaggiOffset = $(this_current).offset().top;
    $('html, body').animate({ scrollTop: '' + (customPaggiOffset - 200) + 'px' }, 800);
}

function displayevent(this_current) {
    $(this_current).find(".item-pagination .page-count b").each(function () {
        if ($(this).css('display') === 'inline') {
            $(this).addClass('selected');
        }
        else {
            $(this).removeClass('selected');
        }
    });
}

/* PAGINATION FUNCTIONS END */
</script>

@endpush