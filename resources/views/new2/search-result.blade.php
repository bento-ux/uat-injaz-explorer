
@extends('new.layout') 
<style>
    a {
        text-decoration: none !important;
    }
</style>

@section('content')
<div class="container mt-5">
    <!-- <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center">
                @component('layouts.search')
                @endcomponent
            </div>
        </div>
    </div> -->

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
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>                    
            </div>
        </form>
        </div>
    </div>

    <h6 class="mb-5">@lang('site.search.hasil_pencarian'): <span>{{ $searchQuery }}</span></h6>

    @if(empty($combinedResults))
        <p>@lang('site.search.not_found')</p>
    @else
        <ul>
            @if($searchType == 'txhash')
               
                    <div class="dashboard">
                        <div class="blockchain-section">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Campaign:</div>
                                    <div class="col-md-8">{{ $combinedResults['campaignName'] }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.transaksi_hash'):</div>
                                    <div class="col-md-8">
                                        <span class="text-break">{{$combinedResults['dbData']['txhash']}}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-4 col-sm-4 fw-bold d-flex align-items-center">@lang('site.detail_campaign.token_penerimaan'):</div>
                                    <div class="col-md-8 col-sm-8 d-flex align-items-center">
                                        <span class="badge bg-primary">{{$combinedResults['dbData']['program']}}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Status:</div>
                                    @if (($combinedResults['dbData']['status'] == 1))
                                        <div class="col-md-8">
                                            <span class="badge bg-success">@lang('site.detail_campaign.tersalurkan')</span>
                                        </div>
                                    @else
                                        <div class="col-md-8">
                                            <span class="badge bg-secondary">@lang('site.detail_campaign.belum_disalurkan')</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.jumlah'):</div>
                                    <div class="col-md-8">₦ {{$combinedResults['dbData']['amount']}}</div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Token:</div>
                                    <!-- <i class="fas fa-coins"></i> -->
                                    <div class="col-md-8 ">{{$combinedResults['dbData']['amount']}} {{$combinedResults['dbData']['tokenUmumSymbol']}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.tanggal_donasi'):</div>
                                    <div class="col-md-8">
                                        {{ \Carbon\Carbon::parse($combinedResults['donationDate'])->translatedFormat('H:i:s  D,d-M-Y') }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.tanggal_penyaluran'):</div>
                                    @if (($combinedResults['dbData']['status']))
                                        <div class="col-md-8">
                                       	                        {{ \Carbon\Carbon::parse($combinedResults['dbData']['tglDisalurkan'])->timezone('Asia/Jakarta')->translatedFormat('H:i:s  D,d-M-Y') }}
					 </div>
                                    @else
                                        <div class="col-md-8">-</div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.transaksi_penyaluran'):</div>
                                    <div class="col-md-8">
                                        @if (($combinedResults['dbData']['status']))
                                            <a href="/token-program/distribusi/tx/{{$combinedResults['dbData']['txhashtokenprogram']}}"
                                                class="text-decoration-none ">
                                                <!-- Data lengkap untuk desktop -->
                                                <span class="tx-desktop">
                                                    {{ $combinedResults['dbData']['txhashtokenprogram'] }}
                                                </span>
                                                <!-- Data dipotong untuk mobile -->
                                                <span class="tx-mobile">
                                                    {{ substr($combinedResults['dbData']['txhashtokenprogram'], 0, 8) . '....' . substr($combinedResults['dbData']['txhashtokenprogram'], -4) }}
                                                </span>
                                            </a>
                                        @else
                                            <a href="#" class="text-decoration-none">
                                                -
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


            @elseif($searchType == 'token')
                @foreach ($combinedResults as $result)
                    <a href="/token-umum/{{ $result['tokenName'] }}">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <p class="text-center">{{ $result['tokenUmumSymbol'] }}</p>
                                    <!-- <img src="{{ $logoPath }}" class="img-fluid rounded-start" alt="..."> -->
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $result['tokenName'] }}</h5>
                                        <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            @elseif($searchType == 'program')
                <!-- Display program search results if needed -->
                @foreach ($combinedResults as $result)
                    <a href="/token-program/{{ $result['program'] }}">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <!-- <div class="col-md-4">
                                                <p class="text-center">{{ $result['tokenUmumSymbol'] }}</p>
                                            </div> -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $result['program'] }}</h5>
                                        <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            @elseif($searchType == 'campaign')
                @foreach ($combinedResults as $result)
                    <a href="/token-umum/tx/{{ $result['txhash'] }}">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $logoPath }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $result['campaignName'] }}</h5>
                                        <p class="card-text">{{ $result['txhash'] }}</p>
                                        <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </ul>
    @endif
</div>
@endsection
