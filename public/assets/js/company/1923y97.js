var territoryAjax = {
    construct: (provienceElement, districtElement, subdistrictElement, villageElement) => {
        provienceEl = provienceElement
        districtEl = districtElement
        subdistrictEl = subdistrictElement
        villageEl = villageElement
    },

    provienceEl: undefined,
    districtEl: undefined,
    subdistrictEl: undefined,
    villageEl: undefined,

    village : (subdistrict) => {
        $.ajax({
			url: territoryUrl.village + subdistrict,
			method: "get",
			cache: false,
			success: function(e){
                if(e.success){
                    if(villageEl !== undefined) {
                        let ref = villageEl.data('ref')
                        villageEl.find('option').remove().end()
                        $.each(e.data, (k, v) => {
                            villageEl.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                        })
                    }
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
                    if(subdistrictEl !== undefined){
                        let ref = subdistrictEl.data('ref'), found = false, mv = ""
                        subdistrictEl.find('option').remove().end()
                        $.each(e.data, (k, v) => {
                            subdistrictEl.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                            found = (!found && v.ref == ref ? true : found)
                            mv = (mv == "" && k == 0 ? v.id : mv)
                        })
                        if(!found){
                            territoryAjax.village(mv)
                        }
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
                    if(districtEl !== undefined){
                        let ref = districtEl.data('ref'), found = false, mv = ""
                        districtEl.find('option').remove().end()
                        $.each(e.data, (k, v) => {
                            districtEl.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                            found = (!found && v.ref == ref ? true : found)
                            mv = (mv == "" && k == 0 ? v.id : mv)
                        })
                        if(!found){
                            territoryAjax.subdistrict(mv)
                        }
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
                    if(provienceEl !== undefined){
                        let ref = provienceEl.data('ref'), found = false, mv = ""
                        provienceEl.find('option').remove().end()
                        $.each(e.data, (k, v) => {
                            provienceEl.append(new Option(v.name, v.id, v.ref == ref, v.ref == ref))
                            found = (!found && v.ref == ref ? true : found)
                            mv = (mv == "" && k == 0 ? v.id : mv)
                        })
                        if(!found){
                            territoryAjax.district(mv)
                        }
                    }
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

                    territoryAjax.construct(provience, district, subdistrict, village)
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
}, branchAjax = {
    data: () => {
        $.ajax({
			url: branchUrl.my,
			method: "get",
			cache: false,
            async: false,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
                if($('.branch-data-box').length > 0){
                    $('.branch-data-box').delete()
                }
                $('.branch-loading-box').show()
			},
			success: function(e){
                if(e.success){
                    if(e.data.length > 0 ){
                        let container = $('#branch-box')
                        e.data.forEach(branch => {
                            container.append(branchAjax.dataBox(branch.id, branch.id_ref, branch.name, branch.simple_name, branch.address, branch.is_main))
                        });
                        loadTooltip()
                    } else {
                        Swal.fire({icon:"error", title:error, text:e.message});
                    }
                }
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
                $('.branch-loading-box').hide()
			},
		})
    },

    create: () => {
        let payload = $('#branch-form').serializeArray()
        $.ajax({
			url: branchUrl.store,
			method: "post",
			cache: false,
            async: false,
            data: payload,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
                $('.branch-loading-box').show()
			},
			success: function(e){
                if(e.success){
                    let data = e.data
                    $('#branch-box').prepend(
                        branchAjax.dataBox(data.id, data.id_ref, data.name, data.simple_name, data.address, data.is_main)
                    )
                    loadTooltip()
                    $('#branchModal').modal('hide')
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: e.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    resetForm('#branch-form')
                    resetValidity()
                } else {
                    Swal.fire({icon:"error", title:error, text:e.message});
                }
			},
			error: function(xhr, status, error){
                if(xhr.responseJSON){
                    data = xhr.responseJSON.data
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: lang.validation_error,
                        showConfirmButton: false,
                        timer: timerLength.swal
                    })
                    validation(data, '-branch')
                } else {
                    console.log(lang.server_error)
                }
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
                $('.branch-loading-box').hide()
			},
		})
    },

    detail: (ref) => {
        let result = undefined
        $.ajax({
			url: branchUrl.detail + '/' + ref,
			method: "get",
			cache: false,
            async: false,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
			},
			success: function(e){
                if(e.success){
                    result = e.data
                } else {
                    Swal.fire({icon:"error", title:error, text:e.message});
                }
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
			},
		})
        return result
    },

    update: () => {
        let frm = $('#branch-form'), payload = frm.serializeArray(), id = $('#branch-ref').val()
        let url = binding(branchUrl.update, {'id': id})
        $.ajax({
			url: url,
			method: "put",
			cache: false,
            async: false,
            data: payload,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
                $('.branch-loading-box').show()
			},
			success: function(e){
                if(e.success){
                    let data = e.data, box = $('[data-branch-ref="'+data.id_ref+'"]')
                    box.remove()
                    $('#branch-box').prepend(
                        branchAjax.dataBox(data.id, data.id_ref, data.name, data.simple_name, data.address, data.is_main)
                    )
                    loadTooltip()
                    $('#branchModal').modal('hide')
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: e.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    resetForm('#branch-form')
                    resetValidity()
                }
			},
			error: function(xhr, status, error){
                if(xhr.responseJSON){
                    data = xhr.responseJSON.data
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: lang.validation_error,
                        showConfirmButton: false,
                        timer: timerLength.swal
                    })
                    validation(data, '-branch')
                } else {
                    console.log(lang.server_error)
                }
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
                $('.branch-loading-box').hide()
			},
		})
    },

    delete: (id, ref) => {
        let url = binding(branchUrl.delete, {'id': id})
        $.ajax({
			url: url,
			method: "delete",
			cache: false,
            async: false,
			beforeSend: function(){
				$('.btn-loading').prop('disabled', 1)
                $('.branch-loading-box').show()
			},
			success: function(e){
                if(e.success){
                    let box = $('[data-branch-ref="'+ref+'"]')
                    box.remove()
                    $('#branchModal').modal('hide')
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: e.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
			},
			error: function(xhr, status, error){
                if(xhr.responseJSON){
                    data = xhr.responseJSON.data
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: lang.validation_error,
                        showConfirmButton: false,
                        timer: timerLength.swal
                    })
                    validation(data, '-branch')
                } else {
                    console.log(lang.server_error)
                }
			},
			complete: function(){
                $('.btn-loading').prop('disabled', 0)
                $('.branch-loading-box').hide()
			},
		})
    },

    dataBox: (id, ref, title, simpleTitle, address, isMain) => {
        return '<div class="col-lg-4 branch-data-box" data-branch-ref="' + ref + '">' +
            '<div class="card">' +
            '    <div class="card-body">' +
            '        <h5 class="card-title"><span data-bs-toggle="tooltip" title="' +title+ '">' + simpleTitle + "</span>" + (isMain ? ' <span class="badge bg-primary">' + lang.main + '<span>' : '') + '</h5>' +
            '        <p class="card-text">' + address + '</p>' +
            '        <div class="card-footer p-0 bg-transparent">' +
            '            <a href="javascript:;" data-bs-toggle="tooltip" title="' + lang.button.edit + '" onclick="edit(\''+ id +'\')" class="btn btn-sm btn-outline-success btn-loading">' + lang.button.edit + '</a>' +
            '            <a href="javascript:;" data-bs-toggle="tooltip" title="' + lang.button.delete + '" onclick="drop(\''+ id +'\', \'' + ref + '\')" class="btn btn-sm btn-outline-danger btn-loading float-end">' + lang.button.delete + '</a>' +
            '        </div>' +
            '    </div>' +
            '</div>' +
        '</div>'
    }
};
$(function(){
    companyAjax.data()
    $('#field-provience, #field-provience-branch').change(function(){
        let v = this.value
        territoryAjax.district(v)
    })
    $('#field-district, #field-district-branch').change(function(){
        let v = this.value;
        territoryAjax.subdistrict(v)
    })
    $('#field-subdistrict, #field-subdistrict-branch').change(function(){
        let v = this.value;
        territoryAjax.village(v)
    })
    $('#company-form').submit(function(e){
        let me = $(this)
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
    branchAjax.data()

    $('#addNew').click(function(){
        openModal(lang.button.new + ' ' + translate.branch, 'new')
    })

    $('#branch-form').submit(function(e){
        let me = $(this), state = me.data('state')
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
                    if(state == 'new'){
                        branchAjax.create()
                    } else {
                        branchAjax.update()
                    }
                }
            });
        }
        me.addClass('was-validated');
    })
})

function openModal(headerText, state, update = false)
{
    let mdl = $('#branchModal'), header = $('#branchModalHeader'), frm = $('#branch-form'), provience = $('#field-provience-branch'), district = $('#field-district-branch'), subdistrict = $('#field-subdistrict-branch'), village = $('#field-village-branch')
    if(!update){
        provience.data('ref', '')
        district.data('ref', '')
        subdistrict.data('ref', '')
        village.data('ref', '')
    }

    header.html(headerText)
    frm.data('state', state)

    mdl.modal('show')
    if(!update){
        territoryAjax.construct(provience, district, subdistrict, village)
        territoryAjax.provience()
    }
    mdl.on('hidden.bs.modal', () => {
        let provience = $('#field-provience'), district = $('#field-district'), subdistrict = $('#field-subdistrict'), village = $('#field-village')
        territoryAjax.construct(provience, district, subdistrict, village)
    })
}

function resetForm(el){
    $(':input', el)
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .prop('checked', false)
    .prop('selected', false);
}

function edit(ref)
{
    let name = $('#field-name-branch'), phone = $('#field-phone_number-branch'), address = $('#field-address-branch'), zip = $('#field-zip_code-branch'), main = $('#field-is_main-branch'), provience = $('#field-provience-branch'), district = $('#field-district-branch'), subdistrict = $('#field-subdistrict-branch'), village = $('#field-village-branch'), id = $('#branch-ref')
    let result = branchAjax.detail(ref)
    if(result !== undefined){
        provience.data('ref', result.provience_id_ref)
        district.data('ref', result.district_id_ref)
        subdistrict.data('ref', result.subdistrict_id_ref)
        village.data('ref', result.village_id_ref)

        name.val(result.name)
        phone.val(result.phone_number)
        zip.val(result.zip_code)
        address.val(result.address)
        main.prop('checked', result.is_main == 1)
        id.val(result.id)

        openModal(lang.button.edit + ' ' + translate.branch, 'edit', true)

        territoryAjax.construct(provience, district, subdistrict, village)
        territoryAjax.provience()
        territoryAjax.district(result.provience_id)
        territoryAjax.subdistrict(result.district_id)
        territoryAjax.village(result.subdistrict_id)
    }
}

function drop(id, ref)
{
    Swal.fire({
        title: lang.confirmation,
        text: lang.msg_confirm_delete,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: lang.confirm_delete,
        cancelButtonText: lang.unconfirm_cancel,
        confirmButtonClass: 'btn btn-primary mt-2',
        cancelButtonClass: 'btn btn-danger ms-2 mt-2',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            branchAjax.delete(id, ref)
        }
    });
}
