
@extends('new.layout') 
@section('content')
<div class="text-center mt-4">
    <h3>@lang('site.detail_campaign.detail_transaksi')</h3>
</div>
@forelse($allData as $result)
    <div class="dashboard m-3">
        <div class="blockchain-section">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Campaign:</div>
                    <div class="col-md-8">{{$result->campaign}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.transaksi_hash'):</div>
                    <div class="col-md-8">
                        <span class="text-break">{{$result->txhash}}</span>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-4 fw-bold d-flex align-items-center">@lang('site.detail_campaign.token_penerimaan'):</div>
                    <div class="col-md-8 col-sm-8 d-flex align-items-center">
                        <span class="badge bg-primary">{{$result->program}}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Status:</div>
                    @if (($result->status == 1))
                        <div class="col-md-8">
                            <span class="badge bg-success">@lang('site.detail_campaign.tersalurkan')</span>
                        </div>
                    @elseif(($result->status == 2))
                        <div class="col-md-8">
                            <span class="badge bg-success">@lang('site.distribution.diterima')</span>
                        </div>
                       
                    @else
                        <div class="col-md-8">
                            <span class="badge bg-secondary">@lang('site.detail_campaign.belum_disalurkan')</span>
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.jumlah'):</div>
                    <div class="col-md-8">₦ {{$result->amount}}</div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Token:</div>
                    <!-- <i class="fas fa-coins"></i> -->
                    <div class="col-md-8 ">{{$result->amount}} {{$result->tokenUmumSymbol}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.tanggal_donasi'):</div>
                    <div class="col-md-8">
                        {{ \Carbon\Carbon::parse($result->tglDonasi)->translatedFormat('H:i:s  D,d-M-Y') }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.tanggal_penyaluran'):</div>
                    @if (($result->status == 1 || $result->status == 2))
                    <div class="col-md-8">
                        <!-- {{ \Carbon\Carbon::parse($result->tglDisalurkan)->translatedFormat('H:i:s  D,d-M-Y') }} -->
                        {{ \Carbon\Carbon::parse($result->tglDisalurkan)->timezone('Asia/Jakarta')->translatedFormat('H:i:s  D,d-M-Y') }}
                    </div>
                    @else
                    <div class="col-md-8">-</div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-4 fw-bold">@lang('site.detail_campaign.transaksi_penyaluran'):</div>
                    <div class="col-md-8">
                        @if (($result->status == 1 || $result->status == 2))
                            <a href="/token-program/distribusi/tx/{{$result->txhashtokenprogram}}" class="text-decoration-none ">
                                <!-- Data lengkap untuk desktop -->
                                <span class="tx-desktop">
                                    {{ $result->txhashtokenprogram }}
                                </span>
                                <!-- Data dipotong untuk mobile -->
                                <span class="tx-mobile">
                                    {{ substr($result->txhashtokenprogram, 0, 8) . '....' . substr($result->txhashtokenprogram, -4) }}
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
@empty
    <p>Error campaign</p>
@endforelse
@endsection