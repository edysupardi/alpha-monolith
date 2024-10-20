@extends('layouts.master-without-nav')
@section('title')
    @lang('title.login')
@endsection
@section('content')

<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="card auth-card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden mb-0">
                                    <div class="card-body p-4 d-flex justify-content-between flex-column">
                                        <div class="auth-image mb-3">
                                            <div class="text-white"><img src="{{ URL::asset('images/company/alpha-light.png') }}" alt="" height="26"/> Alpha</div>
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect-2.png') }}" alt="" class="auth-effect-2" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect-3" />
                                        </div>

                                        <div class="text-center text-white">
                                            <p class="mb-0">&copy; 2024 Copyright
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">@lang('title.welcome_back') !</h5>
                                            <p class="text-muted">@lang('content.signin').</p>
                                        </div>
                                        <div class="p-2 mt-5">
                                            <form id="form">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="field-username" class="form-label">@lang('field.username')</label>
                                                    <input type="text" class="form-control" id="field-username" name="username" placeholder="@lang('field.enter_username')">
                                                    @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="field-password">@lang('field.password') <span class="text-danger">*</span></label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control password-input pe-5" name="password" placeholder="@lang('field.enter_password')" id="field-password" value="">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">@lang('button.signin')</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        var url = {
            signin:     "{{ route('api.signin') }}",
            dashboard:  "{{ route('dashboard') }}"
        }
        lang.button.signin = "@lang('button.signin')"
    </script>
    <script src="{{ URL::asset('pages/login/login-8172g489.js') }}"></script>
@endsection
