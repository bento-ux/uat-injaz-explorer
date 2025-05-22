<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @yield('title')  --}}
    <title></title>
    <META NAME="robots" CONTENT="noindex,nofollow">
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style2.css?v={{ date("YmdHis") }}">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        *, body,h1,h2,h3,h4,h5,h6,p{
            font-family: "Nunito Sans", sans-serif;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
        <img src="/assets/img/pbx.png" class="img-fluid" width="95px" alt="PHILANTHROPHY ON BLOCKS">
        <img src="/assets/img/bmh.jpg" class="img-fluid" width="95px" alt="BAITUL MAAL HIDAYATULLAH">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
<li class="nav-item">
                        <a class="nav-link fw-bold" href="{{url('/')}}">Home</a>
                    </li>               
 <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Config::get('languages')[App::getLocale()] }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <li><a class="dropdown-item fw-bold"
                                            href="{{ route('lang.switch',  $lang) }}">{{$language}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{url('/token-umum')}}">@lang('site.navbar.penerimaan')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{url('/token-program')}}">@lang('site.navbar.penyaluran')</a>
                    </li>
                    
                </ul>
        </div>
    </div>
</nav>
