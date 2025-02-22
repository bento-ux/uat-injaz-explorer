@extends('new.layout') 
@section('content')
<style>
    .custom-card {
        /* border: 1px solid #f0e3b3; Warna garis */
        background-color: #fff;
        /* Warna latar */
        /* border-radius: 8px; */
        padding: 15px;
        display: flex;
        align-items: center;
        box-shadow: 0px 0px 5px rgb(210, 210, 210);
    }

    .custom-icon {
        background-color: #f0e3b3;
        /* Warna ikon */
        border-radius: 50%;
        width: 45px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 15px;
    }

    .custom-token {
        font-weight: bold;
    }

    .token-code {
        font-size: 0.9rem;
    }

    table>tbody>tr>td {
        font-size: 12px
    }

    .dashboard {
        font-family: Arial, sans-serif;
        color: #333;
        padding: 20px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .section-header h3 {
        font-size: 1.2em;
        font-weight: bold;
    }

    .section-header a {
        color: #1a73e8;
        text-decoration: none;
    }

    .blockchain-section,
    .summary-usage,
    .quick-links,
    .uledger-news {
        background: #fff;
        border: 1px solid #e0e0e0;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .blockchain-list {
        display: flex;
        flex-direction: column;
        margin-left: 20px;
    }

    .blockchain-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
        flex-wrap: wrap;
    }

    .blockchain-item:last-child {
        border-bottom: none;
    }

    .blockchain-column {
        flex: 1;
        min-width: 150px;
        margin: 10px 0;
    }

    .blockchain-column-campaign {
        margin-right: 40px;
    }

    .column-label {
        font-size: 0.85em;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .blockchain-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .blockchain-title i {
        color: #4caf50;
    }

    .blockchain-title .tag {
        background-color: #e0f7fa;
        color: #00796b;
        padding: 2px 8px;
        font-size: 0.8em;
        border-radius: 4px;
    }

    .status {
        font-weight: bold;
        color: #4caf50;
    }

    .blockchain-stats {
        display: flex;
        gap: 10px;
    }

    .stat-item {
        display: flex;
        align-items: center;
    }

    .stat-item span:first-child {
        font-weight: bold;
        margin-left: 5px;
    }

    .stat-item i {
        color: #4caf50;
        margin-right: 5px;
    }

    .summary-cards {
        display: flex;
        gap: 15px;
        justify-content: space-between;
    }

    .summary-card {
        text-align: center;
        flex: 1;
    }

    .summary-card h4 {
        font-size: 1.2em;
        color: black;
        font-weight: 600;
    }

    .summary-card p {
        font-size: 1.2em;
        font-weight: bold;
        margin: 0;
    }

    .summary-usage h3 {
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .quick-links ul,
    .uledger-news ul {
        list-style: none;
        padding: 0;
    }

    .quick-links li,
    .uledger-news li {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        font-size: 0.95em;
    }

    .quick-links i,
    .uledger-news i {
        color: #1a73e8;
        margin-right: 8px;
    }

    .summary-card .summary-content {
        display: flex;
        align-items: center;
    }

    .summary-card .icon {
        margin-right: 10px;
        color: #4caf50;
        /* Sesuaikan dengan warna yang Anda inginkan */
        font-size: 1.2em;
        /* Sesuaikan ukuran ikon sesuai kebutuhan */
    }

    .summary-usage {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .summary-usage h3 {
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .summary-cards {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .summary-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        width: 100%;
        max-width: 300px;
        /* Adjust card width on larger screens */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .summary-card h4 {
        font-size: 1.1em;
        margin-bottom: 10px;
        color: #333;
    }

    .summary-content {
        display: flex;
        align-items: center;
        font-size: 1em;
        color: #333;
    }

    .summary-content .icon {
        margin-right: 10px;
        font-size: 1.5em;
        color: #4caf50;
        /* Icon color */
    }

    @media (max-width: 768px) {
        .summary-cards {
            flex-direction: column;
            gap: 10px;
        }

        .summary-card {
            max-width: 100%;
            width: auto;
        }

        .summary-usage h3 {
            font-size: 1.2em;
        }
    }

    /* Desktop: Elemen di sisi kiri */
    @media (min-width: 769px) {
        .summary-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: flex-start;
            /* Desktop: kartu di sisi kiri */
        }

        .summary-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            max-width: 300px;
            /* Lebar kartu tetap 300px */
            width: 100%;
            /* Sesuaikan dengan max-width */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .summary-usage h3 {
            text-align: left;
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }
    }
</style>
<section class="bg-light">
    <section class="container py-5">
        <div class="row mb-5">
        @php
                // Daftar nama program dan kode
            $nama_program = [
                'BMHDKW' => 'Dakwah',
                'BMHEKO' => 'Ekonomi',
                'BMHPDK' => 'Pendidikan',
                'BMHSOK' => 'Sosial Kemanusian',
                'ZKTBMH' => 'Zakat',
                'ZKTFTRH' => 'Zakat Fitrah'
            ];
            @endphp
            <div class="col-sm-12">
                <h1 class="h3 fw-bold text-center">Program BMH {{ isset($nama_program[$program]) ? $nama_program[$program] : $program }}</h1>
            </div>
        </div>
        <div class="row mb-5">
                <div class="col-sm-12">
                    <h2 class="h2 fw-bold">@lang('site.token_program_detail.token_penerimaan')</h2>
                </div>
                @forelse ($tokenListQuery as $result)
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="custom-card rounded-3">
                            <div class="custom-icon">
                                <i class="fa-solid text-theme fa-coins"></i>
                            </div>
                            <div class="w-100">
                                <div class="custom-token">
                                    <h3 class="h5 fw-bold">{{$result->tokenName}}</h3>
                                </div>
                                <div class="token-code" style=" display: flex; justify-content: space-between;">
                                    <span>{{$result->total_amount}}</span>
                                    <label
                                        class="badge bg-light text-dark text-uppercase">{{$result->tokenUmumSymbol}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <p>Tokens have never been distributed</p>
                @endforelse

            <div class="col-sm-12 pt-5">
                <h2 class="h2 fw-bold">@lang('site.token_program_detail.penyaluran')</h2>
            </div>
            @if ($programAmount)
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card rounded-3">
                        <div class="card-title text-center bg-secondary-2 pt-2 rounded-3"
                            style="border-bottom-left-radius:0 !important; border-bottom-right-radius:0 !important">
                            <!-- Tampilkan nilai berdasarkan key yang cocok dengan $results->program -->
                            <h3 class="h6 fw-bold">
                                Total
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="custom-icon" style="background: #DBCCE4 !important">
                                    <i class="fa-solid text-dark fa-users"></i>
                                </div>
                                <div>
                                    <div class="custom-token">{{$programAmount->total_program_amount}}</div>
                                    <label class="text-uppercase">{{$program}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>Gagal Mengambil total Token</p>
            @endif

        </div>
        <h2 class="h2 fw-bold">@lang('site.token_program_detail.transaksi')</h2>
        <div class="blockchain-section">
            
            <div class="blockchain-list mt-4">
                @forelse ($allData as $results)
                    <div class="blockchain-item" key={index}>
                        <div class="blockchain-column blockchain-column-campaign">
                            <div class="column-label">Campaign</div>
                            <div class="blockchain-title">
                                <i class="fas fa-network-wired"></i>
                                <span>{{$results->campaign}}</span>
                                <span class="tag">{{$results->program}}</span>
                            </div>
                        </div>
                        <div class="blockchain-column">
                            <div class="column-label">@lang('site.token_program_detail.jumlah')</div>
                            <div class="stat-item">
                                <i class="fas fa-coins"></i>
                                <div class="status">
                                    {{$results->amount}} {{$results->tokenUmumSymbol}}
                                </div>
                            </div>
                        </div>
                        <div class="blockchain-column">
                            <div class="column-label">@lang('site.token_program_detail.transaksi_hash')</div>
                            <div class="blockchain-stats">
                                <div class="stat-item">
                                    <i class="fas fa-link"></i>
                                    <a href="/token-umum/tx/{{ $results->txhash }}">
                                        <span>
                                            {{ substr($results->txhash, 0, 8) . '....' . substr($results->txhash, -4) }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="blockchain-column">
                            <div class="column-label">Status</div>
                            <div class="blockchain-stats">
                                <div class="stat-item">
                                    @if (($results->status == 1))
                                        <i class="fas fa-circle-check"></i>
                                        <span>@lang('site.token_program_detail.tersalurkan')</span>
                                    @elseif(($results->status == 2))
                                            <i class="fas fa-hand-holding-hand"></i>
                                            <span>@lang('site.distribution.diterima')</span>
                                    @else
                                        <i class="fas fa-hourglass-start"></i>
                                        <span>@lang('site.token_program_detail.belum_disalurkan')</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>There is no campaign yet</p>
                @endforelse
            </div>
        </div>

    </section>

</section>

@endsection