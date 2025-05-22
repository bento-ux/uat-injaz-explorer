@extends('new.layout') 
@section('content')
<section class="bg-light">
    <section class="container-fluid py-5">
        <div class="row mb-5">
            <div class="col-sm-12">
                <h1 class="h3 fw-bold text-center">IBANTU BLOCKCHAIN EXPLORER</h1>
            </div>
            <div class="col-md-6 offset-md-3">
            <form method="GET" action="{{ url('/search-proses') }}">
            @csrf
                <div class="row">                   
                    <div class="col-10 g-1 mb-3">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search.placeholder')..." ></div>
                    <div class="col-2 g-1">
                        <button class="btn btn-primary" type="submit">@lang('site.search.cari')</button>
                    </div>                    
                </div>
            </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-5">
                <h2 class="badge text-bg-danger mb-4">Philantrophy on Block</h2>
                <div class="card">
                    <div class="card-body">
                        <img src="/assets/img/bmh.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container-fluid mb-5" style="padding:0">
                    <div class="row">
                        <div class="col-sm-12"><h2 class="h2 fw-bold">@lang('site.home.penerimaan')</h2></div>
                        @php
                            // Daftar icon sesuai urutan
                            $icons = [
                                'fa-solid fa-hand-holding-dollar',
                                'fa-solid fa-hand-holding-dollar',
                                'fa-solid fa-handshake-simple',
                                'fa-solid fa-handshake-simple',
                            ];
                        @endphp
                        @forelse ($tokenUmum as $index => $result)
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="/token-umum/{{ $result->tokenName }}" class="card text-decoration-none">
                                    <div class="card-body">
                                        <div style="display: flex">
                                            <div class="p-2 bg-success-2 rounded-3 me-3" style="height:100%">
                                                <i class="{{ $icons[$index % count($icons)] }}"></i>
                                            </div>
                                            <div>
                                                <!-- <label for="">Infaq</label> -->
                                                <h6 class="fw-bold" style="line-height:1;margin-bottom:0">{{$result->tokenName}}</h6>
                                                <h6 class="fw-bold">₦{{$result->totalAmount}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p>No Yet Token Penerimaan</p>
                        @endif
                    </div>
                </div>
                <div class="container-fluid mb-5" style="padding:0">
                    <div class="row">
                        <div class="col-sm-12"><h2 class="h2 fw-bold">@lang('site.home.penyaluran')</h2></div>
                        @php
                            // Daftar icon sesuai urutan
                            $icons = [
                                'fa-solid text-dark fa-users',
                                'fa-solid fa-sack-dollar',
                                'fa-solid fa-graduation-cap',
                                'fa-solid fa-share-nodes',
                                'fa-solid fa-hands-holding-child',
                                'fa-solid fa-hand-holding-heart'
                                
                            ];
                        @endphp
                        @forelse ($tokenProgram as $index => $result)
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="/token-program/{{ $result->program }}" class="card text-decoration-none">
                                    <div class="card-body">
                                        <div style="display: flex">
                                            <div class="p-2 bg-secondary-2 rounded-3 me-3" style="height:100%">
                                                <!-- Pilih icon sesuai indeks, gunakan modulus untuk mengulang jika jumlah data lebih banyak dari icon -->
                                                <i class="{{ $icons[$index % count($icons)] }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold" style="line-height:1;margin-bottom:0">{{ $result->program }}</h6>
                                                <h6 class="fw-bold">₦{{$result->totalAmount}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p>No Yet Token Penyaluran</p>
                        @endforelse
                
                    </div>
                </div>
                <div class="container-fluid mb-5" style="padding:0">
                    <div class="row">
                        <div class="col-sm-12"><h2 class="h2 fw-bold">@lang('site.home.berita_terbaru')</h2></div>
                       
                        <!-- <div class="col-lg-4 mb-3">
                            <div class="card rounded-3">
                                <img class="img-fluid img-thumbnail-news" src="/assets/img/news/IMG-20240404-WA0007-scaled.webp" class="card-img-top" alt="Revolusi Filantropi Digital: iBantu, BMH, dan DOKU Siap Terapkan Teknologi Blockchain dalam Amal di Indonesia ">
                                <div class="card-body">
                                    <h6 style="font-size:16px" class="fw-bold card-title">Revolusi Filantropi Digital: iBantu, BMH, dan DOKU Siap Terapkan Teknologi Blockchain dalam Amal di Indonesia </h6 style="font-size:16px">
                                    <a href="#" class="text-decoration-none text-dark">Baca Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="card rounded-3">
                                <img class="img-fluid img-thumbnail-news" src="/assets/img/news/IMG-20240404-WA0007-scaled.webp" class="card-img-top" alt="Revolusi Filantropi Digital: iBantu, BMH, dan DOKU Siap Terapkan Teknologi Blockchain dalam Amal di Indonesia ">
                                <div class="card-body">
                                    <h6 style="font-size:16px" class="fw-bold card-title">Revolusi Filantropi Digital: iBantu, BMH, dan DOKU Siap Terapkan Teknologi Blockchain dalam Amal di Indonesia </h6 style="font-size:16px">
                                    <a href="#" class="text-decoration-none text-dark">Baca Selengkapnya...</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid py-5 bg-theme-light rounded-4">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="fw-bolder">@lang('site.home.kamu_tertarik') <span class="text-theme">@lang('site.home.donasi')?</span></h2>
                <p>@lang('site.home.berikan_manfaat')</p>
                <a href="https://uat.injazfoundation.com/" target="_blank" class="btn btn-lg btn-outline-primary fw-bold">@lang('site.home.donasi_sekarang')</a>
            </div>
        </div>
    </section>
</section>

@endsection 
