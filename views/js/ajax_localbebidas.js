$(document).ready(function () {
    $('#frmRegistroLocalBebida').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
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
                tblLocalBebidas.ajax.reload();                
                $(".Select2").val(null).trigger('change');
                $('form#frmRegistroLocalBebida')[0].reset();
            } else if ($data == 'repeat') {
                toastr.warning('La sede ya contiene la bebida registrada')
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    $('#frmActualizarLocalBebida').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Actualizado Exitosamente');
                tblLocalBebidas.ajax.reload();
                $(".selectFrm").val(null).trigger('change');
                $('form#frmActualizarLocalBebida')[0].reset();
                $("#mdlActualizarLocalBebida").modal("hide");
            } else if ($data == 'repeat') {
                toastr.warning('La sede ya contiene la bebida registrada')
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
});

function btnEditarLocalBebida($id_localbebida) {
    $.ajax({
        url: 'ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php',
        type: 'post',
        data: 'id_localbebida='+ $id_localbebida,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#idLocalbebida').val($data['id_localbebida']);
        $('#estadoED').val($data['estado']);
        $('#listarLocalED').val($data['id_local']);
        $('#listarLocalED').trigger('change');
        $('#listarBebidaED').val($data['id_bebida']);
        $('#listarBebidaED').trigger('change');
    });
}

function btnEliminarLocalBebida($id_localbebida){
    Swal.fire({
        title: '¿Está seguro de eliminar?',
        text: "Se eliminará la bebida con el local asignado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
                type: "post",
                data: "id_localbebidaElm=" + $id_localbebida,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'La bebida con el local asignado fue eliminado.',
                        'success'
                    )
                    tblLocalBebidas.ajax.reload();
                } else if ($data == 'usado') {
                    toastr.warning('No se puede eliminar, la fila tiene registro en el módulo Inventario Bebidas, "Inactivar" status');
                }else{
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })
        } else {
            alertify.error('Canceló la operación');
        }
    })
}
function btnInactivoLocalBebida($id_localbebida){
    $.ajax({
        url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
        type: "post",
        data: "id_inactivo=" + $id_localbebida,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema',);
        }
    }).done(function (respuesta) {
        $data = respuesta.response;
        if ($data == "true") {
            alertify.success('Se realizó cambio de estado "Inactivo"');
            tblLocalBebidas.ajax.reload();
            tblBebidaInventarioH.ajax.reload();
            $("#tbl_inventariobebidas").DataTable().ajax.reload();
            
        } else {
            if ($data == 'error') {
                swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
}
function btnReingresarBebidasLocal($id_localbebida){
    Swal.fire({
        title: 'Estás seguro en reingresar la bebida?',
        text: "Se reingresará la bebida de la sede!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Reingresar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
                type: "post",
                data: "id_reingresar=" + $id_localbebida,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema',);
                }
            }).done(function (respuesta) {
                $data = respuesta.response;
                if ($data = "true") {
                    Swal.fire(
                        'Reingresado!',
                        'La bebida fue reingresado...',
                        'success'
                    )
                    tblLocalBebidas.ajax.reload();
                    tblBebidaInventarioH.ajax.reload();
                    $("#tbl_inventariobebidas").DataTable().ajax.reload();
                } else {
                    if ($data == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })

        } else {
            alertify.error('Canceló la operación');
        }
    });
}
