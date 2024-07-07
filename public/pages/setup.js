/**
 * AJAX SETUP
 */
$( document ).ajaxSend( (event, request, settings) => {
    clearValidation()
})
$.ajaxSetup({
    headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

function ajaxError(a, b, c)
{
    console.log(a, b, c);
    // if(a.responseJSON){
    //     let t = a.responseJSON.message, d = a.responseJSON.data, m = ""
    //     $.each(d, (k, v) => { m += v[0] })
    //     Swal.fire({
    //         title: t,
    //         html: m,
    //         icon: "error",
    //     });
    //     if(m == lang.error.invalid_captcha && $('.btn-re-captcha').length > 0){
    //         if($("#field-captcha").length > 0)
    //             $('#field-captcha').val('')
    //         $('.btn-re-captcha').trigger('click')
    //     }
    // }
    // else{
    //     let pesan = lang !== undefined && lang.error.default !== undefined ? lang.error.default : "Internal server error";
    //     Swal.fire({icon:"error", title:"Bad Response :'(", text: pesan});
    // }
}
