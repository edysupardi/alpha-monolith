@extends('layouts.master-without-nav')

@section('title')
@lang('title.login')
@endsection

@section('body')

<body class="auth-body-bg">
@endsection

    @section('content')

    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">
                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">
                                                <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">Alpha</span> Medika</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="javascript:;" class="d-block auth-logo">
                                        <img src="{{ URL::asset('/assets/images/company/alpha-dark.png') }}" alt="" height="28" class="auth-logo-dark">
                                        <img src="{{ URL::asset('/assets/images/company/alpha-light.png') }}" alt="" height="28" class="auth-logo-light">
                                        Alpha
                                    </a>
                                </div>
                                <div class="my-auto">
                                    <div>
                                        <h5 class="text-primary">@lang('content.welcome_back') !</h5>
                                        <p class="text-muted">@lang('content.signin')</p>
                                    </div>

                                    <div class="mt-4">
                                        <form class="form-horizontal" method="POST" id="login-form">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">@lang('field.enter_email')</label>
                                                <input name="email" type="email" class="form-control" id="email" placeholder="@lang('field.enter_email')" autocomplete="email" autofocus>
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="text-muted">@lang('content.forgot_password')?</a>
                                                    @endif
                                                </div>
                                                <label class="form-label">@lang('field.password')</label>
                                                <div class="input-group auth-pass-inputgroup" id="password">
                                                    <input type="password" name="password" class="form-control" placeholder="@lang('field.enter_password')" aria-label="Password" aria-describedby="password-addon" autocomplete="password" autofocus>
                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light btn-loading" type="submit">@lang('button.login')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">&copy; {{ date('Y') }} Alpha. Crafted with <i class="mdi mdi-heart text-danger"></i></p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
@endsection

@section('script')
    <script>
        var signin = "{{ route('signin') }}", dashboard = "{{ route('dashboard') }}"
        var lang = {
            login : "@lang('button.login')",
            loading : "@lang('content.loading')",
            server_error: "@lang('content.server_error')",
            information: "@lang('content.information')",
            error: "@lang('content.error')",
        }
    </script>
    <script src="{{ URL::asset('/assets/js/login/login-8172g489.js') }}"></script>
@endsection
