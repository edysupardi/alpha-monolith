<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') | Alpha</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Alpha Medika"/>
        <meta name="description" content="Aplikasi Medis Terintegrasi, Simple, dan Modis"/>
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png')}}">
        @include('layouts.head-css')
    </head>

    @yield('body')

    @yield('content')

    @include('layouts.vendor-scripts')
    </body>
</html>
