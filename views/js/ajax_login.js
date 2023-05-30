$(document).ready(function () {
    $('form#formlogin').submit((e) => {
        e.preventDefault();
        $form = $('#formlogin');
        dataform = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLogin/Login.ajax.php",
            type: 'POST',
            data: dataform,
            dataType: 'json',
            success: function (res) {
                $response = res.response;
                $rol = res.rol
                if ($response == 'isvalid') {
                    if($rol == 'Administrador General' || $rol == 'Administrador'){
                        window.location = "inicio";
                    } else if($rol == 'Jefe de Cocina'){
                        window.location = "Cocina";
                    } else if($rol == 'Counte en caja'){
                        window.location = "caja";
                    }else if($rol == 'Delivery motorizado'){
                        window.location = "Motorizado";
                    }else if($rol == 'Mozo/Azafata'){
                        window.location = "caja";
                    }
                } else if ($response == "desactivado") {
                    swal.fire('Invalidado, tu cuenta se ha dado desactivado!', 'Conversar con el ADMINISTRADOR', 'warning');
                } else if ($response == 'notfound') {
                    swal.fire('Upss!', 'El correo o la contraseña está incorrecto', 'info');
                } else {
                    if ($data == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            },
            error: function (e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        });
    });
});