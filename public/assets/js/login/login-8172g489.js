$(function(){
    $('#login-form').submit(function(e){
        e.preventDefault()
        var me = $(this), v = me.serializeArray()
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
                    console.log(e)
					// Swal.fire({icon:"error", title:'Oops', text:e.message});
				}
			},
			error: function(a){

			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
				$('#login-form').find(':submit').text(lang.login)
			},
		})
    })
})
