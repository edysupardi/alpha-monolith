$(function(){
    $('#login-form').submit(function(e){
        e.preventDefault()
        resetValidity()
        var me = $(this), v = me.serializeArray()
        if (me[0].checkValidity() === false) {
			e.stopPropagation();
        } else {
            $.ajax({
                url: signin,
                method: "POST",
                cache: false,
                dataType: 'json',
                data: v,
                beforeSend: function(){
                    $('.btn-loading').prop('disabled', 1)
                    $('#login-form').find(':submit').text(lang.loading)
                },
                success: function(e){
                    if(e.success){
                        window.location = dashboard;
                    }else{
                        Swal.fire({icon:"error", title:error, text:e.message});
                    }
                },
                complete: function(){
                    $('.btn-loading').prop('disabled', 0)
                    $('#login-form').find(':submit').text(lang.login)
                },
            })
        }
    })
})
