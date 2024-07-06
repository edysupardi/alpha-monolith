<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title> @hasSection('title')
        @yield('title') -
     @endif @lang('title.app')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Hybrix Laravel Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="keywords" content="hybrix,hybrix laravel,admin,dashboard,vite,livewire,livewire admin,laravel vite">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
    @include('layouts.head-css')
</head>

<body>
    @yield('content')
    @include('layouts.vendor-scripts')
</body>

</html>

