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
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('pages/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- <script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script> --}}
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
<script src="{{ URL::asset('pages/setup.js') }}"></script>
<script src="{{ URL::asset('pages/supervision.js') }}"></script>
<script src="{{ URL::asset('pages/validation.js') }}"></script>
<script src="{{ URL::asset('pages/helper.js') }}"></script>

@yield('script')
