$(document).ready(function () {
    $('#frmRegistroClientefre').submit(function (e) {        
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();        
        $.ajax({
            url: "ajax/SessionAjaxClientesFre/Clientesfrecuentas.ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {            
            $data = respuesta.response;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblclientesfre.ajax.reload();
                $('#mdlClientesfre').modal('hide');
                $('form#frmRegistroClientefre')[0].reset();
            } else if ($data == 'repeat') {
                alertify.warning('Este cliente ya esta registrado en la sede');
            }else {
                if($data == 'error'){
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema',);
                }
            }
        });
        
    });
    
});

function btnEditarClientefre(id_cliente_frecuenteA) {
    $.ajax({
        url: "ajax/SessionAjaxClientesFre/Clientesfrecuentas.ajax.php",
        type: "post",
        data: "id_cliente_frecuenteA=" + id_cliente_frecuenteA,
        dataType: 'json',
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_cliente_frecuenteEdit').val($data['id_cliente_frecuente']);
        $('#nombreEdit').val($data['nombre_completo']);
        $('#telefonoEdit').val($data['telefono']);
        $('#emailEdit').val($data['correo']);
        $('#descuentoEdit').val($data['descuento']);
        $('#local_clifreEdit').val($data['id_local']);
        $('#estadoEdit').val($data['estado']);

    });
}

$('form#frmUpClientefre').submit(function (e) {
    e.preventDefault();
    var $form = $(this);
    datos = $form.serialize();
    $.ajax({
        url: "ajax/SessionAjaxClientesFre/Clientesfrecuentas.ajax.php",
        type: "post",
        data: datos,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.response;
        if ($data == 'actualizado') {
            toastr.info('Los datos fueron "Actualizados"');
            tblclientesfre.ajax.reload();
            $("#mdlClientesfreUp").modal("hide");
        } else if ($data == 'repeat') {
            alertify.warning('Este cliente ya esta registrado en la sede');
        } else {
            if ($data == 'error'){
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }            
        }
    });
});

function btnEliminarClientefre(id_ClienteFrecuEli){
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará el Cliente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxClientesFre/Clientesfrecuentas.ajax.php",
                type: "post",
                data: "id_ClienteFrecuEli=" + id_ClienteFrecuEli,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.response;
                if ($data == 'eliminado') {
                    Swal.fire(
                        'Eliminado!',
                        'El cliente fue eliminado.',
                        'success'
                    )
                    tblclientesfre.ajax.reload();
                } else {
                    if ($data == 'error'){
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }            
                }
            })

        } else {
            alertify.error('Canceló la operación');
        }
    })
}