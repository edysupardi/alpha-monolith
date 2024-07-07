let cls = "is-invalid", clsFeedback = "invalid-feedback"
function validation(data)
{
    if(data != null) {
        $.each(data, (elId, v) => {
            let el = $("#" + elId), msg = v[0], elName = $('[name="' + elId + '"]')
            if(el.length > 0) {
                el.addClass(cls)
                let feedback = invalidFeedback(msg)
                el.after(feedback)

                if(elName.length > 0) {
                    $.each(elName, (k, i) => {
                        $(i).addClass(cls)
                    })
                }
            }
        })
    }
}

function invalidFeedback(msg)
{
    return "<span class='" + clsFeedback + "' role='alert'><strong>" + msg + "</strong></span>"
}

function clearValidation()
{
    $("." + clsFeedback).remove()
    $("." + cls).removeClass(cls)
}
