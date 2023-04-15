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

    @section('body')
        <body data-topbar="dark" data-sidebar="dark">
    @show

        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <!-- Start content -->
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- content -->
                </div>
                @include('layouts.footer')
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        @include('layouts.right-sidebar')
        <!-- END Right Sidebar -->

        @include('layouts.vendor-scripts')
    </body>

</html>
