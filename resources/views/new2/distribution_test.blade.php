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
    .content {
  height: 100vh; }

.modal {
  border-radius: 7px;
  overflow: hidden;
  background-color: transparent;
  font-family: "Poppins", sans-serif; }
  .modal .logo a img {
    width: 30px; }
  .modal .modal-content {
    background-color: transparent;
    border: none;
    border-radius: 7px; }
    .modal .modal-content .modal-body {
      border-radius: 7px;
      overflow: hidden;
      background-color: #fff;
      padding-left: 0px;
      padding-right: 0px;
      -webkit-box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
      box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9); }
      .modal .modal-content .modal-body h2 {
        font-size: 18px; }
      .modal .modal-content .modal-body p {
        color: #777;
        font-size: 14px; }
      .modal .modal-content .modal-body h3 {
        font-weight: 900;
        color: #000;
        font-size: 22px; }
      .modal .modal-content .modal-body .close-btn {
        color: #000; }
      .modal .modal-content .modal-body .promo-img {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%; }
  .modal .cancel {
    color: gray;
    font-size: 14px; }
  .modal .btn-primary {
    padding-top: 10px;
    padding-bottom: 10px; }

.form-control {
  border: transparent;
  -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
  border: none; }
  .form-control:active, .form-control:focus, .form-control:hover {
    -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2); }

.btn {
  border-radius: 4px;
  border: none; }
  .btn:active, .btn:focus {
    outline: none;
    -webkit-box-shadow: none !important;
    box-shadow: none !important; }

.custom-select {
  border: none;
  -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2); }
  .custom-select:active, .custom-select:focus, .custom-select:hover {
    -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2); }

.bg-image {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat; }

.logo img {
  width: 70px; }

.custom-note {
  color: #999; }
  .custom-note a {
    color: #555;
    font-weight: 900 !important; }
</style>
<section class="bg-light">
    <section class="container py-5">
        <div class="row mb-5">
            <div class="col-sm-12">
                <h1 class="h3 fw-bold text-center">@lang('site.distribution.penyaluran')</h1>
            </div>
            <div class="text-center mb-3">
                <span
                    class="card d-inline-flex p-2 fw-bold text-light bg-secondary h6">{{$transactions->tokenName}}</span>
                <i class="fa-solid fa-chevron-right px-2"></i>
                <span
                    class="card d-inline-flex p-2 fw-bold bg-secondary-2 text-dark h6">{{$transactions->program}}</span>
            </div>

            <div class="dashboard">
                <div class="summary-usage">
                    <!-- <div class="section-header"></div> -->
                    @if ($transactions)
                        <div class="summary-cards">
                            <div class="summary-card">
                                <h4>Signers</h4>
                                <ul class="list-group list-group-flush">
                                    @foreach (json_decode($transactions->signers) as $signer)
                                        <li class="list-group-item">
                                            {{ substr($signer, 0, 8) . '....' . substr($signer, -6) }}
                                            <!-- {{ $signer }} -->
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="summary-card">
                                <h4>@lang('site.distribution.tanggal_penyaluran')</h4>
                                <!-- <span>{{$transactions->lastDistributionDate}}</span> -->
                                {{ \Carbon\Carbon::parse($transactions->lastDistributionDate)->timezone('Asia/Jakarta')->translatedFormat('H:i:s  D,d-M-Y') }}
                                <!-- <span>{{ \Carbon\Carbon::parse($transactions->lastDistributionDate)->translatedFormat('H:i:s  D,d-M-Y') }}</span> -->
                                <br>
                                <h4 class="mt-4">@lang('site.distribution.jumlah')</h4>
                                <span>{{$transactions->total_amount}} {{$transactions->tokenUmumSymbol}} </span>
                            </div>
                          
                            <div class="summary-card">
                                <h4>Bukti Penerimaan</h4>
                                @if($laporanDetails->isEmpty())
                                    <p>Masih dalam proses penerimaan</p>
                                @else
                                    <div class="row">
                                        <div class="d-grid gap-2" style="grid-template-columns: repeat(2, 1fr);">
                                            @foreach ($laporanDetails as $laporan)
                                                <div class="mb-2">
                                                    <img src="{{ $laporan->nama_gambar ? asset('images/'.$laporan->nama_gambar) : 'https://via.placeholder.com/150' }}" 
                                                        class="img-fluid img-thumbnail" 
                                                        alt="{{ $laporan->judul }}" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#exampleModalCenter{{ $loop->index }}" 
                                                        style="object-fit: cover; height: 100px; width: 100%;">

                                                    <!-- <h5 class="mt-2">{{ $laporan->judul }}</h5>
                                                    <p>Deskripsi: {{ $laporan->deskripsi }}</p>
                                                    <p>Petugas: {{ $laporan->petugas }}</p> -->

                                                    <!-- Modal untuk gambar -->
                                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
                                                            <div class="modal-content rounded-0">
                                                            <div class="modal-body py-0">

                                                                
                                                                <div class="d-block main-content">
                                                                <img src="images/undraw_updated_rr85.svg" alt="Image" class="img-fluid" style="background-color: #b2fcff;">
                                                                <div class="content-text p-4">
                                                                    
                                                                    <h3 class="mb-4">Introducing Work from Anywhere</h3>
                                                                    <p class="mb-4">All their equipment and instruments are alive. The sky was this is cloudless and of a deep dark blue. A shining crescent far beneath the flying vessel.</p>
                                                                    <div class="d-flex">
                                                                    <div class="ml-auto">
                                                                        <a href="#" class="btn btn-link" data-dismiss="modal">No thanks</a>
                                                                        <a href="#" class="btn btn-primary px-4">Get the app</a>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>

                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $loop->index }}"             aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                            <div class="modal-header text-start">
                                                                <div>
                                                                    <h3 class="modal-title" id="imageModalLabel{{ $loop->index }}">{{ $laporan->judul }}</h3>
                                                                    
                                                                    <p class="mt-2">
                                                                        <strong>Deskripsi:</strong> <span class="text-muted small">{{ $laporan->deskripsi }}</span>
                                                                    </p>
                                                                    <p class="mt-1">
                                                                        <strong>Amil:</strong> <span class="text-muted small">{{ $laporan->petugas }}</span>
                                                                    </p>
                                                                </div>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ $laporan->nama_gambar ? asset('images/'.$laporan->nama_gambar) : 'https://via.placeholder.com/150' }}" class="img-fluid" alt="{{ $laporan->judul }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                       
                    @else
                        <p>Gagal Mengambil transaksi</p>
                    @endif

                </div>
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
                                    <div class="column-label">@lang('site.distribution.jumlah')</div>
                                    <div class="stat-item">
                                        <i class="fas fa-coins"></i>
                                        <div class="status">
                                            {{$results->amount}} {{$results->tokenUmumSymbol}}
                                        </div>
                                    </div>
                                </div>
                                <div class="blockchain-column">
                                    <div class="column-label">@lang('site.distribution.transaksi_hash')</div>
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
                                                <span>@lang('site.distribution.tersalurkan')</span>
                                            @elseif(($results->status == 2))
                                                <i class="fas fa-hand-holding-hand"></i>
                                                <span>@lang('site.distribution.diterima')</span>
                                            @else
                                                <i class="fas fa-hourglass-start"></i>
                                                <span>@lang('site.distribution.belum_disalurkan')</span>
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




            </div>
        </div>

    </section>

</section>

@endsection