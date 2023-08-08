$(document).ready(function () {
    $('#frmRegistroBebidaInventario').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            data: datos,
            type: "post",
            dataType: 'json',
            url: "ajax/SessionAjaxInventarioBebidas/inventariobebidas_ajax.php",
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.response;
            if ($data == 'guardado') {
                toastr.success('Registrado Exitosamente');
                tblBebidaInventario.ajax.reload();
                tblBebidaInventarioH.ajax.reload();
                $(".Select2").val(null).trigger('change');
                $('form#frmRegistroBebidaInventario')[0].reset();
            } else if ($data == "repeat") {
                toastr.warning("La bebida local ya se encuentra registrada")
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('#desplegarsede').on('change', function () {
        let $data = $('#desplegarsede').val();
        let datasend = $data;
        $('#tbl_inventariobebidas').DataTable().clear();
        $('#tbl_inventariobebidas').DataTable().destroy();
        tblInventarioAdmGnrl = $('#tbl_inventariobebidas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            ajax: {
                url: "ajax/SessionAjaxInventarioBebidas/listar_inventariobebidaxsede.php",
                type: "post",
                data: {
                    name_sede: datasend,
                },
                dataSrc: ''
            },
            columns: [
                { 'data': 'bebida' },
                { 'data': 'stock_total' },
                { 'data': 'sede' },
                { 'data': 'stockestado' },
                { 'data': 'estado' },
                { 'data': 'acciones' },
            ]
        })
    })

});

$('#localAdmGnr').on('change', function () {
    bebidaSedes = [];
    $.ajax({
        data: "listarBebidaselect=" + $('#localAdmGnr').val(),
        type: "post",
        url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
        success: function (response) {
            bebidaSede = JSON.parse(response);
            html = '<option value="" selected>Seleccione Bebida</option>';
            for (var i = 0; i < bebidaSede.length; i++) {
                bebidaSedes.push(bebidaSede[i]);
            }
            for (let BebidaS of bebidaSedes) {
                html += `<option value='${BebidaS.id_localbebida}'>${BebidaS.marca} || ${BebidaS.descripcion}</option>`;
            }
            document.getElementById("listarBebida").innerHTML = html
        }
    })
})

function btnEditarBebidaInventario(id_mostrar) {
    $.ajax({
        data: "id_mostrar=" + id_mostrar,
        type: "post",
        dataType: 'json',
        url: "ajax/SessionAjaxInventarioBebidas/inventariobebidas_ajax.php",
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_blEditar').val($data['id_inventario']);
        $('#listarSedeEditar').val($data['sede']);
        $('#listarSedeEditar').trigger('change');
        setTimeout(function(){
            $('#listarBebidaEditar').val($data['id_localbebida']);
        },100)
        $('#stockEditar').val($data['stock']);
    });
}


$('#listarSedeEditar').on('change', function () {
    var listaBebidas = "listarBebidaselect=" + $('#listarSedeEditar').val();
    bebidaSedes = [];
    $.ajax({
        data: listaBebidas,
        url: "ajax/SessionAjaxLocalBebidas/localbebidas_ajax.php",
        type: "post",
        dataType: 'json',
        success: function (response) {
            bebidaSede = response;
            html = '<option value="" >Seleccione Bebida</option>';
            for (var i = 0; i < bebidaSede.length; i++) {
                bebidaSedes.push(bebidaSede[i]);
            }
            for (let BebidaS of bebidaSedes) {
                html += `<option value='${BebidaS.id_localbebida}'>${BebidaS.marca} || ${BebidaS.descripcion}</option>`;
            }
            document.getElementById("listarBebidaEditar").innerHTML = html
        }
    })
})

$('#frmActualizarbebidaInventario').submit(function (e) {
    e.preventDefault();
    var $form = $(this);
    datos = $form.serialize();
    $.ajax({
        data: datos,
        type: "post",
        dataType: 'json',
        url: "ajax/SessionAjaxInventarioBebidas/inventariobebidas_ajax.php",
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.response;
        if ($data == 'actualizado') {
            toastr.info('Datos Actualizados');
            tblBebidaInventario.ajax.reload();
            tblBebidaInventarioH.ajax.reload();
            $("#mdlActualizarBebidaInventario").modal("hide");
            $(".Select2").val(null).trigger('change');
            $('form#frmActualizarbebidaInventario')[0].reset();
        }else if ($data == "repeat") {
            toastr.warning("La bebida local ya se encuentra registrada")
        } 
        else {
            if ($data == 'error') {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
});

function btnEliminarBebidaInventario(id_bl) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará el bebida ingresado en el inventario !!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                data: "id_eliminar=" + id_bl,
                url: "ajax/SessionAjaxInventarioBebidas/inventariobebidas_ajax.php",
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.response;
                if ($data = "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'El bebida en el inventario fue eliminado.',
                        'success'
                    )
                    tblBebidaInventario.ajax.reload();
                    tblBebidaInventarioH.ajax.reload();
                } else {
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })

        } else {
            toastr.error('Canceló la operación');          
        }
    })
    
}

