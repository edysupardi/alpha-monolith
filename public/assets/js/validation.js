let cls = "is-invalid", clsValidation = "invalid-validation", clsInvalidFeedback = "invalid-feedback", clsValidFeedback = "valid-feedback"
function validation(data, suffixEl = '') {
    if(data != null) {
        clearFeedback()
        $.each(data, (elId, v) => {
            let el = $("#field-" + elId + suffixEl), msg = v[0], elName = $('[name="' + elId + '"]')
            if(el.length > 0) {
                invalidFeedback(msg, elId + suffixEl)

                // if(elName.length > 0) {
                //     $.each(elName, (k, i) => {
                //         $(i).addClass(cls)
                //     })
                // }
                el.addClass(cls)
            }
        })
    }
}

function invalidFeedback(msg, param)
{
    let e = "field-" + param + "Feedback", el = $('#' + e);
    el.html(msg)
    el.show()
    document.getElementById("field-" + param).setCustomValidity(msg)
}

function clearValidation()
{
    $("." + clsValidation).remove()
    $("." + cls).removeClass(cls)
}

function clearFeedback()
{
    $("." + clsValidFeedback).hide()
    $('.needs-validation').removeClass('was-validated')
}

function resetValidity() {
    clearFeedback()
    var el = document.getElementsByClassName('form-control');
    el.forEach(itm => {
        itm.setCustomValidity('')
    })
}
