<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title> @yield('title') | Alpha</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="token" content="{{ Session::get('token') }}">
        <meta name="token_type" content="{{ Session::get('token_type') }}">
        <meta name="author" content="Alpha Medika"/>
        <meta name="description" content="Aplikasi Medis Terintegrasi, Simple, dan Modis"/>
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png')}}">
        @include('layouts.head-css')
    </head>

    @section('body')
        <body data-sidebar="dark">
    @show
        <div id="layout-wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>

        @include('layouts.vendor-scripts')
    </body>

</html>
