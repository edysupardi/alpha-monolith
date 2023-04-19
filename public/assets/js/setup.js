/**
 * AJAX SETUP
 */
$( document ).ajaxSend( (event, request, settings) => {
    clearValidation()
})
$.ajaxSetup({
    headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': $('meta[name="token_type"]').attr('content') + ' ' + $('meta[name="token"]').attr('content')
    },
    error: function (xhr, status, error) {
        if(xhr.responseJSON){
            let msg = xhr.responseJSON.message, data = xhr.responseJSON.data
            errorManagement(msg, data)
        } else {
            console.log(lang.server_error)
        }
    },
});
