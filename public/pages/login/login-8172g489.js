$(function(){
    $('#form').submit(function(e){
        e.preventDefault()
        var me = $(this), v = me.serializeArray()
        $.ajax({
			url: url.signin,
			method: "POST",
			cache: false,
			dataType: 'json',
			data: v,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
				$('#form').find(':submit').text(lang.loading)
			},
			success: function(e){
                window.location = url.dashboard;
			},
			error: function(a, b, c){
                ajaxError(a, b, c)
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
				$('#form').find(':submit').text(lang.button.signin)
			},
		})
    })

    $('#password-addon').click(function(){
        let t = $('#field-password').attr('type')
        $('#field-password').attr('type', t == 'password' ? 'text' : 'password')
    })
})
