@extends('vue.layouts.main')

@push('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fix For Chunk Error In Webpack and Vue Router -->
    <base href="/"/>
@endpush

@push('favicon')
    <link rel="shortcut icon" href="/img/favicon.ico?v=2" type="image/x-icon"/>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/old.css') }}">
@endpush

@push('header_js')
    <script>
        window.App = {!! json_encode([
            'ssl_on'       => config('websockets.ssl.on'),
            'csrfToken'    => csrf_token(),
            'env'          => config('app.env'),
            'api_endpoint' => config('app.api'),
            'site' => [
                'trademark' => 'bangergames'
]
        ]) !!};
    </script>
@endpush

@push('title')
    <title>{{ config('app.name') }} </title>
@endpush

@section('content')
    <div id="app" v-cloak>
        <div id="v-cloak--block">
            <div class="loader">
               <!-- preloader area start -->
                <div class="preloader" id="preloader">
                    <div class="loader loader-1">

                        <div class="loader-outter"></div>
                        <div class="loader-inner"></div>
                    </div>
                    <div class="loader-line-wrap">
                        <div class="loader-line"></div>
                    </div>
                </div>
                <!-- preloader area end -->
            </div>
        </div>
        {{-- <app></app> --}}
    </div>
@endsection

@push('footer_js')
    <!-- Load Socket If Echo is ON -->
    @if(config('echo.realtime'))
        <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    @endif

    @if(config('app.env') !== 'production')
        <!-- Local ENV Assets -->
        <script src="{{mix('/js/app.js')}}"></script>


    @else
        <!-- Production ENV Assets -->
        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{mix('/js/vendor.js')}}"></script>
        <script src="{{mix('/js/app.js')}}"></script>

    @endif

@endpush
