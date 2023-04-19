var territoryAjax = {
    village : (subdistrict) => {
        $.ajax({
			url: territoryUrl.village + subdistrict,
			method: "get",
			cache: false,
			success: function(e){
                if(e.success){
                    let select = $('#field-village'), ref = select.data('ref')
                    select.find('option').remove().end()
                    $.each(e.data, (k, v) => {
                        select.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                    })
                }
			},
		})
    },
    subdistrict : (district) => {
        $.ajax({
			url: territoryUrl.subdistrict + district,
			method: "get",
			cache: false,
			success: function(e){
                if(e.success){
                    let select = $('#field-subdistrict'), ref = select.data('ref'), found = false, mv = ""
                    select.find('option').remove().end()
                    $.each(e.data, (k, v) => {
                        select.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                        found = (!found && v.ref == ref ? true : found)
                        mv = (mv == "" && k == 0 ? v.id : mv)
                    })
                    if(!found){
                        territoryAjax.village(mv)
                    }
                }
			},
		})
    },
    district : (provience) => {
        $.ajax({
			url: territoryUrl.district + provience,
			method: "get",
			cache: false,
			success: function(e){
                if(e.success){
                    let select = $('#field-district'), ref = select.data('ref'), found = false, mv = ""
                    select.find('option').remove().end()
                    $.each(e.data, (k, v) => {
                        select.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                        found = (!found && v.ref == ref ? true : found)
                        mv = (mv == "" && k == 0 ? v.id : mv)
                    })
                    if(!found){
                        territoryAjax.subdistrict(mv)
                    }
                }
			},
		})
    },
    provience: () => {
        $.ajax({
			url: territoryUrl.provience,
			method: "get",
			cache: false,
			success: function(e){
                if(e.success){
                    let select = $('#field-provience'), ref = select.data('ref')
                    select.find('option').remove().end()
                    $.each(e.data, (k, v) => {
                        select.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                    })
                }
			},
		})
    },
}, companyAjax = {
    data: () => {
        $.ajax({
			url: companyUrl.my,
			method: "get",
			cache: false,
            async: false,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
			},
			success: function(e){
                if(e.success){
                    let data = e.data, provience = $('#field-provience'), district = $('#field-district'), subdistrict = $('#field-subdistrict'), village = $('#field-village'), name = $('#field-name'), phoneNumber = $('#field-phone_number'), zipCode = $('#field-zip_code'), address = $('#field-address')
                    provience.data('ref', data.provience_id_ref)
                    district.data('ref', data.district_id_ref)
                    subdistrict.data('ref', data.subdistrict_id_ref)
                    village.data('ref', data.village_id_ref)
                    name.val(data.name)
                    phoneNumber.val(data.phone_number)
                    zipCode.val(data.zip_code)
                    address.val(data.address)

                    territoryAjax.provience()
                    territoryAjax.district(data.provience_id)
                    territoryAjax.subdistrict(data.district_id)
                    territoryAjax.village(data.subdistrict_id)
                }
			},
			error: function(a){

			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
			},
		})
    },
    update: () => {
        let payload = $('#company-form').serializeArray()
        $.ajax({
			url: companyUrl.update,
			method: "put",
			cache: false,
            async: false,
            data: payload,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
                $('.loading-btn').removeClass('d-none')
			},
			success: function(e){
                if(e.success){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: e.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    resetValidity()
                }
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
                $('.loading-btn').addClass('d-none')
			},
		})
    }
};
$(function(){
    companyAjax.data()
    $('#field-provience').change(function(){
        let v = this.value;
        territoryAjax.district(v)
    })
    $('#field-district').change(function(){
        let v = this.value;
        territoryAjax.subdistrict(v)
    })
    $('#field-subdistrict').change(function(){
        let v = this.value;
        territoryAjax.village(v)
    })
    $('#company-form').submit(function(e){
        let me=$(this)
        e.preventDefault()
        resetValidity()
        if (me[0].checkValidity() === false) {
			e.stopPropagation();
        } else {
            Swal.fire({
                title: lang.confirmation,
                text: lang.msg_confirm_submit,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: lang.confirm_submit,
                cancelButtonText: lang.unconfirm_cancel,
                confirmButtonClass: 'btn btn-primary mt-2',
                cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    companyAjax.update()
                }
            });
        }
        me.addClass('was-validated');
    })
})
