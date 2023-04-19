function errorManagement(message, data = null){
    if(message == "validation errors"){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: lang.validation_error,
            showConfirmButton: false,
            timer: timerLength.swal
        })
        validation(data)
    }
}
