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
                        <img src="/assets/img/bmh.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container-fluid mb-5" style="padding:0">
                    <div class="row">
                        <div class="col-sm-12"><h2 class="h2 fw-bold">@lang('site.token_program.penyaluran')</h2></div>
                        @php

                            $icons = [
                                'fa-solid text-dark fa-users',
                                'fa-solid fa-sack-dollar',
                                'fa-solid fa-graduation-cap',
                                'fa-solid fa-share-nodes',
                                'fa-solid fa-hands-holding-child',
                                'fa-solid fa-hand-holding-heart'
                                
                            ];

                        // Daftar nama program
                        $program = [
                            'Dakwah',
                            'Ekonomi',
                            'Pendidikan',
                            'Sosial Kemanusian',
                            'Zakat',
                            'Zakat Fitrah'
                        ];
                        @endphp
                        @forelse ($results as $index => $result)
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="/token-program/{{ $result->program }}" style="text-decoration:none"> 
                                    <div class="card">
                                        <div class="card-body">
                                            <div style="display: flex">
                                                <div class="p-2 bg-secondary-2 rounded-3 me-3" style="height:100%">
                                                    <i class="{{ $icons[$index % count($icons)] }}"></i>
                                                </div>
                                                <div>
                                                    <label for="">{{ $program[$index % count($program)] }}</label>
                                                    <h6 class="fw-bold" style="line-height:1;margin-bottom:0">{{ $result->program }}</h6>
                                                    <h6 class="fw-bold">₦{{$result->totalAmount}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a> 
                            </div>
                        @empty
                        <p>Belum ada Token Penyaluran</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection 