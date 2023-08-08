$(document).ready(function () {
    

    

});

function btnEditarLocalEmpleado(id_localempleadoA) {
    $.ajax({
        url: "ajax/SessionAjaxLocalEmpleado/localempleado_ajax.php",
        type: "post",
        data: "id_localempleadoA=" + id_localempleadoA,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_localempleadoED').val($data['id_localemple']);
        $('#id_empleadoED').val($data['id_empleado']).trigger('change');
        // $('#item_empleEditar').trigger('change');
        $('#id_localED').val($data['id_local']).trigger('change');
        // $('#item_localEditar').trigger('change');
    });
}

function btnEliminarLocalEmpleado(id_localempleado) {
    Swal.fire({
        title: '¿Esta seguro que desea eliminar?',
        text: "Se eliminará al empleado con el local asignado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxLocalEmpleado/localempleado_ajax.php",
                type: "post",
                data: "id_localempleadoElm=" + id_localempleado,
                dataType: "json",
            }).done(function (respuesta) {
                if (respuesta.responseJson == 'eliminado') {
                    Swal.fire(
                        'Eliminado',
                        'El empleado con el local asignado fue eliminado.',
                        'success'
                    )
                    tblLocalEmpleado.ajax.reload();
                }
                else if (respuesta.responseJson == 'tieneus') {
                    toastr.warning('Upss! El empleado tiene un usuario registrado');          
                }else{
                    if (respuesta.responseJson == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            });
        } else {
            toastr.error('Canceló la operación');          
            // alertify.error('Canceló la operación').css('background-color', 'red').css('color', 'white'); // Cambia el estilo de la notificación
        }
    });
}