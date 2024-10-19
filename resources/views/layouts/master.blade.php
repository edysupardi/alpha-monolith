<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light"  data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title> @hasSection('title')
        @yield('title') -
     @endif @lang('title.app')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Aplikasi pencatatan rekam medis" name="description" />
    <meta content="Alpha" name="author" />
    <meta name="keywords" content="alpha,rm,rekam medis,rekam medik">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
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
        </div>
    </div>

    @include('layouts.vendor-scripts')
</body>

</html>
