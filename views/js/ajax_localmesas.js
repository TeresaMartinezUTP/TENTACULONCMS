$(document).ready(function () {
    $('form#frmRegistroLocalMesa').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalMesas/localmesas_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {            
            $data = respuesta.response;            
            if ($data == 'guardado') {
                toastr.success('Registrado Exitosamente');
                tblLocalMesa .ajax.reload();
                $('form#frmRegistroLocalMesa')[0].reset();                
                $(".select2").val(null).trigger('change');
                setTimeout(function(){
                    $(".js-example-basic-single").val('').trigger('change')
                    }, 300);
            } else if ($data == 'repeat') {
                toastr.warning('Upss! El el número de mesa se repite');          
            }else{
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
});
$('form#frmActualizarLocalMesa').submit(function (e) {
    e.preventDefault();
    var $form = $(this);
    datos = $form.serialize();
    $.ajax({
        url: "ajax/SessionAjaxLocalMesas/localmesas_ajax.php",
        type: "post",
        data: datos,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.response;
        if ($data == 'actualizado') {
            toastr.info('Datos Actualizados');
            tblLocalMesa.ajax.reload();
            $('form#frmActualizarLocalMesa')[0].reset();
            $(".select2").val(null).trigger('change');
            $("#mdlActualizarLocalMesa").modal("hide");
        } 
        else if ($data == 'repeat') {
            toastr.warning('Upss! El el número de mesa se repite');          
        }else{
            if ($data == 'error') {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
});
function btnEditarLocalmesa(id_mesa) {
    $.ajax({
        url: "ajax/SessionAjaxLocalMesas/localmesas_ajax.php",
        type: "post",
        data: "id_mesa=" + id_mesa,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#item_localEditar').val($data['id_local']);
        $('#item_localEditar').trigger('change');
        $('#nom_mesaEditar').val($data['nombre_mesa']);
        $('#idLocalMesa').val($data['id_mesa']);
        $('#estadoMesa').val($data['estado']);

    });
}

function btnEliminarlocalmesa(id_mesa) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará la mesa del local!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxLocalMesas/localmesas_ajax.php",
                type: "post",
                data: "id_mesaElm=" + id_mesa,
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                if (respuesta = "ok") {
                    Swal.fire(
                        'Eliminado!',
                        'La mesa del local fue eliminado.',
                        'success'
                    )
                    tblLocalMesa .ajax.reload();
                }
            })

        } else {
            alertify.error('Canceló la operación');
        }
    })
}