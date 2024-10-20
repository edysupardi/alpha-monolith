<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

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

<body>
    @yield('content')
    {{-- @include('layouts.vendor-scripts') --}}
    <!-- JAVASCRIPT -->
    <script>
        var lang = {
            loading: "@lang('content.loading')",
            error:  {
                invalid_captcha: "@lang('content.invalid_captcha')",
                error: "@lang('content.error')"
            },
            button: {
                submit: "@lang('button.submit')",
                cancel: "@lang('button.cancel')",
                delete: "@lang('button.delete')",
                edit: "@lang('button.edit')",
                update: "@lang('button.update')",
                back: "@lang('button.back')",
            }
        }
    </script>
    <script src="{{ URL::asset('pages/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/layout.js') }}"></script>
    <script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('pages/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('pages/setup.js') }}"></script>
    <script src="{{ URL::asset('pages/supervision.js') }}"></script>
    <script src="{{ URL::asset('pages/validation.js') }}"></script>
    <script src="{{ URL::asset('pages/helper.js') }}"></script>

@yield('script')

</body>

</html>

