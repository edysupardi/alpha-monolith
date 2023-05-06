<script>
    var lang = {
        loading : "@lang('content.loading')",
        server_error: "@lang('content.server_error')",
        information: "@lang('content.information')",
        error: "@lang('content.error')",
        confirmation: "@lang('content.confirmation')",
        msg_confirm: "@lang('content.msg_confirm')",
        msg_confirm_delete: "@lang('content.msg_confirm_delete')",
        msg_confirm_submit: "@lang('content.msg_confirm_submit')",
        confirm: "@lang('content.confirm')",
        confirm_delete: "@lang('content.confirm_delete')",
        confirm_submit: "@lang('content.confirm_submit')",
        yes: "@lang('content.yes')",
        unconfirm: "@lang('content.unconfirm')",
        unconfirm_cancel: "@lang('content.unconfirm_cancel')",
        validation_error: "@lang('content.validation_error')",
        main: "@lang('content.main')",
        button: {
            add: "@lang('button.add')",
            new: "@lang('button.new')",
            edit: "@lang('button.edit')",
            delete: "@lang('button.delete')",
            add_new: "@lang('button.add_new')",
        }
    }, timerLength = {
        swal: 1500
    }
</script>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/setup.js') }}"></script>
<script src="{{ URL::asset('assets/js/supervision.js') }}"></script>
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<script src="{{ URL::asset('assets/js/helper.js') }}"></script>
@yield('script')

<!-- App js -->
<script src="{{ URL::asset('assets/js/app.min.js')}}"></script>

@yield('script-bottom')
