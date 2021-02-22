function setPassword() {
    Swal.fire({
        title: 'Digita tu contraseña actual',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Cambiar',
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                check_pass(result);
                
            }
        })
}

function check_pass(pass) {
    
    $.ajax({
        type: 'POST',
        url: baseurl + 'api/usuario/check_actual_password',
        data: pass,
        success: function (res) {
            if (res) {
                Swal.fire({
                    title: 'Digita tu nueva contraseña',
                    input: 'password',
                    inputAttributes: {
                    autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            new_password(result);
                        }
                    })
            } else {
                Swal.fire('Error en contraseña', '', 'error');
            }
        }
    });	
}

function new_password(pass) {
    
    $.ajax({
        type: 'POST',
        url: baseurl + 'api/usuario/new_pass',
        data: pass,
        success: function (res) {
            if (res) {
                Swal.fire('Nueva Contraseña asignada correctamente', '', 'success');
            } else {
                Swal.fire('Error en contraseña', '', 'error');
            }
        }
    })
}