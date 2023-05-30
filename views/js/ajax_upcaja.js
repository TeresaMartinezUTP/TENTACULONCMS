seccplatoup = $('.seccplato');
seccbebidaup = $('.seccbebida');
let id_venta;
let descuento;

//VER DETALLES VENTA
function btnverdetalleventa(id_venta, tabla) {
    $('#id_ventaglobal').val(id_venta);
    id_venta = $('#id_ventaglobal').val();
    $('.buscarPlatoedit').val("");
    $('.buscarBebidaedit').val("");

    id = "#" + tabla.id;
    $(id).DataTable().clear();
    $(id).DataTable().destroy();
    mostrardatosventa2(id_venta);
    btnEditarventa(id_venta);
    MostrarPlatosedit();
    tblCajaedit = $(id).DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCocina/listar_derventa.php",
            type: "POST",
            data: {
                id_venta: id_venta, cajaPresencial: 'cajaPresencial'
            },
            dataSrc: ''
        },
        'sDom': 't',
        //"bInfo":false,
        //"bFilter": false,
        //"paging": false,
        pageLength: 100,
        "ordering": false,
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'nombre_producto' },
            { 'data': 'precio_venta' },
            { 'data': 'cantidades' },
            { 'data': 'total' },
            { 'data': 'acciones' }
        ],
    });
    //$(".montocaja").attr("id_venta", id_venta);
}

//MOSTRAR DATOS DV
function mostrardatosventa2(id_venta) {
    $.ajax({
        url: "ajax/SessionAjaxCocina/mostrardatosventa2.php",
        type: "post",
        data: "id_venta=" + id_venta,
        dataType: 'json',
    }).done(function (respuesta) {
        $data = respuesta;
        console.log(respuesta);
        let subtotal = 0.00;
        subtotal = $data['subtotal'];
        montopagado = $data['monto_pagado'];
        vuelto = $data['vuelto'];
        $('.subtotalcaja').val(subtotal);
        $('.totalcaja').val((subtotal - descuento).toFixed(2));
        $(".montocaja").val(montopagado);
        calcularVuelto($data['atencion']);
        //$('#igvcaja').val($data['igv']);
        $('.selectP').on('change', function () {
            sel = '#' + this.id;
            let p = $(sel + ' option:selected').val();
            $data["prioridad"] = p;
            $.ajax({
                url: "ajax/SessionAjaxCaja/actualizarprioridad.php",
                type: "post",
                data: $data,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (rpt) {
                tblupcaja.ajax.reload();
                tblDelivery.ajax.reload();
                tblRecojo.ajax.reload();
            });
        })
        $('.selectCF').on('change', function () {
            sel = '#' + this.id;
            let data = $(sel + ' option:selected').val();
            let datasend = 'id_cliente_frecuenteA=' + data;
            $.ajax({
                url: "ajax/SessionAjaxClientesFre/Clientesfrecuentas.ajax.php",
                type: "post",
                data: datasend,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta2) {
                $data2 = respuesta2;
                if ($data2['descuento'] == null) {
                    descuento = "0.00";
                    $('.subtotalcaja').val(subtotal);
                    $('.descuentocaja').val(descuento);
                    $('.totalcaja').val(subtotal);
                } else {
                    descuento = $data2['descuento'];
                    $('.subtotalcaja').val(subtotal);
                    $('.descuentocaja').val(descuento);
                    $('.totalcaja').val((subtotal - descuento).toFixed(2));
                }
            });
            $.ajax({
                url: "ajax/SessionAjaxClientesFre/actualizarclifre.ajax.php",
                type: "post",
                data: {
                    "id_cliente_frecuenteA": data,
                    "id_venta": $('#id_ventaglobal').val()
                },
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta2) {
            });
            setTimeout(function () {
                calcularVuelto($data['atencion']);
                $(".montocaja").trigger('change');
            }, 100);
        });
    });
    $.ajax({
        url: "ajax/SessionAjaxVenta/listar_ventaparte.php",
        type: "post",
        data: "id_venta=" + $('#id_ventaglobal').val(),
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta3) {
        if(respuesta3 != "vacio"){
            $("#avisoppk").html('<div class="alert alert-danger" role="alert">La venta se está pagando por partes</div>');
            $("#mpcajaEdit").attr("disabled",true);
        } else{
            $("#mpcajaEdit").attr("disabled",false);
            $("#avisoppk").html("");
        }
    });
}

//MOSTRAR DATOS VENTAS
function btnEditarventa(id_venta) {
    $.ajax({
        url: "ajax/SessionAjaxCocina/mostrar_venta.php",
        type: "post",
        data: "id_venta=" + id_venta,
        dataType: 'json',
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_mesaventaEdit').val($data['id_mesa']);
        $('#id_mesaventaEditm').val($data['nombre_mesa']);
        $('#prioridadEdit').val($data['prioridad']);
        $('#prioridadEditD').val($data['prioridad']);
        $('#prioridadEditR').val($data['prioridad']);
        $('#id_clifreventaEdit').val($data['id_cliente_frecuente']).trigger('change');
        $('#clifreventeDelivery').val($data['id_cliente_frecuente']).trigger('change');
        $('#clifreventeRecojo').val($data['id_cliente_frecuente']).trigger('change');
        $('#nameclienteRecojo').val($data['nombre_contacto']);
        $('#nameclienteDelivery').val($data['nombre_contacto']);
        $('#telefonoRecojo').val($data['telefono']);
        $('#telefono').val($data['telefono']);
        $('#direccionDelivery').val($data['direccion']);
    });
}

// MOSTRAR Y BUSCAR PLATOS-BEBIDAS
function MostrarPlatosedit() {
    id_venta = $('#id_ventaglobal').val();
    $('.buscarPlatoedit').val("")
    seccplatoup.removeClass('d-none');
    seccbebidaup.addClass('d-none');
    catalagos = $('.bPlatoedit');
    catalagos.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxBuscar/BuscarAjax.php",
        data: "nombre=" + "",
        dataType: 'json',
    }).done(function (respuesta) {
        //mostrardatosventa();
        $plato = respuesta;
        for (let i = 0; i < $plato.length; i++) {
            $imagen = $plato[i]['imagen'];
            catalagos.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='plato'>
                    <img class="card-img-top" height="130" src="views/imgplato/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$plato[i]['nombre_plato']}</span>
                        <h5 class="card-title">S/ ${$plato[i]['precio']} </h5>                        
                        <form method="post" id='frmplatoedit${i}'>
                            <input type="hidden" name="id_venta_venta" id="id_venta_venta" value="${id_venta}">
                            <input type="hidden" name="id_localplatoventa" id="id_localplatoventa" value="${$plato[i]['id_plato']}">
                            <input type="hidden" name="precioventa" id="precioventa" value="${$plato[i]['precio']}">
                            <input type="hidden" name="cantidad_venta" id="cantidad_venta" value="1">
                            <button class="btn btn-primary"  value="Agregar" type="submit"> Agregar </button>
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmplatoedit' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCocina/registrar_upventa.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa2(id_venta);
                        tblupcaja.ajax.reload();
                        tblRecojo.ajax.reload();
                        tblCajaedit.ajax.reload();
                        toastr.info('Plato añadido');
                    } else if ($data == 'repeat') {
                        toastr.warning('El Plato ya esta registrado');

                    } else {
                        if ($data == 'error') {
                            swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                        }
                    }
                });
            });
        }

    });
}
function BuscarPlatosedit(id) {
    id_venta = $('#id_ventaglobal').val();
    const buscarPlato = document.querySelector('#' + id);
    catalagos = $('.bPlatoedit');
    catalagos.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxBuscar/BuscarAjax.php",
        data: "nombre=" + buscarPlato.value,
        dataType: 'json',
    }).done(function (respuesta) {
        //mostrardatosventa();
        $plato = respuesta;
        for (let i = 0; i < $plato.length; i++) {
            $imagen = $plato[i]['imagen'];
            catalagos.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='plato'>
                    <img class="card-img-top" height="130" src="views/imgplato/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$plato[i]['nombre_plato']}</span>
                        <h5 class="card-title">S/ ${$plato[i]['precio']} </h5>                        
                        <form method="post" id='frmplatoedit${i}'>
                            <input type="hidden" name="id_venta_venta" id="id_venta_venta" value="${id_venta}">
                            <input type="hidden" name="id_localplatoventa" id="id_localplatoventa" value="${$plato[i]['id_plato']}">
                            <input type="hidden" name="precioventa" id="precioventa" value="${$plato[i]['precio']}">
                            <input type="hidden" name="cantidad_venta" id="cantidad_venta" value="1">
                            <button class="btn btn-primary"  value="Agregar" type="submit"> Agregar </button>
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmplatoedit' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCocina/registrar_upventa.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa2(id_venta);
                        tblCajaedit.ajax.reload();
                        tblupcaja.ajax.reload();
                        tblRecojo.ajax.reload();
                        toastr.info('Plato añadido');
                    } else if ($data == 'repeat') {
                        toastr.warning('El Plato ya esta registrado');

                    } else {
                        if ($data == 'error') {
                            swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                        }
                    }
                });
            });
        }

    });
}
function MostrarBebidasedit() {
    id_venta = $('#id_ventaglobal').val();
    $('.buscarBebidaedit').val("")
    seccbebidaup.removeClass('d-none');
    seccplatoup.addClass('d-none');
    catalago1 = $('.bBebidaedit');
    catalago1.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxBuscar/BuscarBebidaAjax.php",
        data: "descripcion=" + "",
        dataType: 'json',
    }).done(function (respuesta) {
        $bebida = respuesta;
        for (let i = 0; i < $bebida.length; i++) {
            $imagen = $bebida[i]['ruta_imagen'];
            catalago1.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='bebida'>
                    <img class="card-img-top" height="130" src="views/imgbebida/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$bebida[i]['descripcion']} </span>
                        <h5 class="card-title">S/ ${$bebida[i]['precio']} </h5>
                        <form id='frmbebidaventaedit${i}' method="post">
                            <input type="hidden" name="id_venta_bebida" id="id_venta_bebida" value="${id_venta}">
                            <input type="hidden" name="id_localbebidaventa" id="id_localbebidaventa" value="${$bebida[i]['id_bebida']}">
                            <input type="hidden" name="precioventabedida" id="precioventabedida" value="${$bebida[i]['precio']}">
                            <input type="hidden" name="cantidad_ventabebida" id="cantidad_ventabebida" value="1">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit"> Agregar </button>
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmbebidaventaedit' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCocina/registrar_upbebida.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa2(id_venta);
                        tblCajaedit.ajax.reload();
                        tblupcaja.ajax.reload();
                        tblRecojo.ajax.reload();
                        toastr.info('Bebida añadida');
                    } else if ($data == 'repeat') {
                        toastr.warning('La bebida ya esta registrada');
                    } else {
                        if ($data == 'error') {
                            swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                        }
                    }
                });
            });
        }
    });
}
function BuscarBebidasedit(id) {
    id_venta = $('#id_ventaglobal').val();
    const buscarBebida = document.querySelector('#' + id);
    catalago1 = $('.bBebidaedit');
    catalago1.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxBuscar/BuscarBebidaAjax.php",
        data: "descripcion=" + buscarBebida.value,
        dataType: 'json',
    }).done(function (respuesta) {
        $bebida = respuesta;
        for (let i = 0; i < $bebida.length; i++) {
            $imagen = $bebida[i]['ruta_imagen'];
            catalago1.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='bebida'>
                    <img class="card-img-top" height="130" src="views/imgbebida/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$bebida[i]['descripcion']} </span>
                        <h5 class="card-title">S/ ${$bebida[i]['precio']} </h5>
                        <form id='frmbebidaventaedit${i}' method="post">
                            <input type="hidden" name="id_venta_bebida" id="id_venta_bebida" value="${id_venta}">
                            <input type="hidden" name="id_localbebidaventa" id="id_localbebidaventa" value="${$bebida[i]['id_bebida']}">
                            <input type="hidden" name="precioventabedida" id="precioventabedida" value="${$bebida[i]['precio']}">
                            <input type="hidden" name="cantidad_ventabebida" id="cantidad_ventabebida" value="1">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit"> Agregar </button>
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmbebidaventaedit' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCocina/registrar_upbebida.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa2(id_venta);
                        tblCajaedit.ajax.reload();
                        tblupcaja.ajax.reload();
                        tblRecojo.ajax.reload();
                        toastr.info('Bebida añadida');
                    } else if ($data == 'repeat') {
                        toastr.warning('La bebida ya esta registrada');
                    } else {
                        if ($data == 'error') {
                            swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                        }
                    }
                });
            });
        }
    });
}

//SUMAR Y RESTAR CANTIDADES DE PRODUCTOS, ELIMINAR PRODUCTO DE DETALLE VENTA
function btnSumarTotalVentaedit(cantidad, id_detalle) {
    id_venta = $('#id_ventaglobal').val();
    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_total.php",
        type: "post",
        data: { "cantidad": cantidad, "id_detalle": id_detalle },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa2(id_venta);
        $data = respuesta.response;
        tblCajaedit.ajax.reload();
        tblupcaja.ajax.reload();
        tblRecojo.ajax.reload();
        tblCajapendiente.ajax.reload();

    })
}
function btnRestarTotalVentaedit(cantidad, id_detalle) {
    id_venta = $('#id_ventaglobal').val();
    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_total.php",
        type: "post",
        data: { "cantidad": cantidad, "id_detalle": id_detalle },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa2(id_venta);
        tblCajaedit.ajax.reload();
        $data = respuesta.response;
        tblRecojo.ajax.reload();
        tblupcaja.ajax.reload();
        setTimeout(function () {
        tblCajapendiente.ajax.reload();
    }, 200);

    })
}
function btnEliminarDetventa(id_detEli) {
    id_venta = $('#id_ventaglobal').val();
    $.ajax({
        url: "ajax/SessionAjaxCaja/eliminar_detventa.php",
        type: "post",
        data: "id_detEli=" + id_detEli,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa2(id_venta);
        $data = respuesta.response;
        tblCajaedit.ajax.reload();
        tblRecojo.ajax.reload();
        tblupcaja.ajax.reload();
        setTimeout(function () {
            tblCajapendiente.ajax.reload();
        }, 200);

    })
}

// CANTIDAD PREPARADA
function btnSumarcantidadpreparada(cantidad, id_detalle) {
    id_venta = $('#id_ventaglobal').val();
    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_cantidadpreparada.php",
        type: "post",
        data: { "cantidad": cantidad, "id_detalle": id_detalle },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa2(id_venta);
        $data = respuesta.response;
        tblupcaja.ajax.reload();
        tblRecojo.ajax.reload();
        tblDelivery.ajax.reload();
        setTimeout(function () {
            tblCajapendiente.ajax.reload();
        }, 200);
    })
}
function btnRestarcantidadpreparada(cantidad, id_detalle) {
    id_venta = $('#id_ventaglobal').val();
    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_cantidadpreparada.php",
        type: "post",
        data: { "cantidad": cantidad, "id_detalle": id_detalle },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa2(id_venta);
        tblupcaja.ajax.reload();
        tblRecojo.ajax.reload();
        tblDelivery.ajax.reload();
        setTimeout(function () {
            tblCajapendiente.ajax.reload();
        }, 200);
        $data = respuesta.response;
    })
}

//VER DETALLE DE VENTA PENDIENTE
function btnverdetalleventapendiente(id_venta) {
    $('#id_ventaglobal').val(id_venta);
    $('#tblCajapendiente').DataTable().clear();
    $('#tblCajapendiente').DataTable().destroy();
    tblCajapendiente = $('#tblCajapendiente').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCocina/listar_derventa.php",
            type: "POST",
            data: {
                id_venta: id_venta,
            },
            dataSrc: ''
        },
        'sDom': 't',
        //"bInfo":false,
        //"bFilter": false,
        //"paging": false,
        pageLength: 100,
        "ordering": false,
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'nombre_producto' },
            { 'data': 'precio_venta' },
            { 'data': 'cantidadsoli' },
            { 'data': 'cantidadcoci' },
        ],
    });
    setTimeout(function () {
        tblCajapendiente.ajax.reload();
    }, 200);
}
function PrepararTodo() {
    id_venta = $('#id_ventaglobal').val();
    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_cantpagada.php",
        type: "post",
        data: { "preparartodo": id_venta },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa2(id_venta);
        tblupcaja.ajax.reload();
        tblRecojo.ajax.reload();
        tblDelivery.ajax.reload();
        tblCajapendiente.ajax.reload();
        toastr.success('Todo preparado');
    })
}
//FINALIZAR VENTA
function btnFinalizarVenta(id_venta) {
    Swal.fire({
        title: '¿Estás seguro en finalizar la venta?',
        text: "No se podra deshacer esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, finalizar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxCocina/actualizarestadoventa.php",
                type: "post",
                data: "id_venta=" + id_venta,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.response;
                if ($data == 'guardado') {
                    Swal.fire(
                        'Finalizado!',
                        'Se genero el ticket en el modulo Venta.',
                        'success'
                    )
                    tblupcaja.ajax.reload();
                    tblRecojo.ajax.reload();
                } else {
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

// PAGO POR PARTES
function pagarXpartes(id_ventas) {
    id_venta = id_ventas;
    $('#tblCajapagoxpartes').DataTable().clear();
    $('#tblCajapagoxpartes').DataTable().destroy();
    tblCajapagoxpartes = $('#tblCajapagoxpartes').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCocina/listar_derventa.php",
            type: "POST",
            data: {
                id_venta: id_venta,
            },
            dataSrc: ''
        },
        'sDom': 't',
        //"bInfo":false,
        //"bFilter": false,
        //"paging": false,
        pageLength: 100,
        "ordering": false,
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'descripcion' },
            { 'data': 'precio_venta' },
            { 'data': 'cantidadsoli' },
            { 'data': 'cantidadrest' },
            { 'data': 'cantidadpaga' },
        ],
    });
    setTimeout(function () {
        tblCajapagoxpartes.ajax.reload();
        disabledBtnCancelar();
    }, 200);

    $("#subttlpartes").val(parseFloat(0).toFixed(2));
    $("#ttlpartes").val(parseFloat(0).toFixed(2));
    $("#mppartes").val(parseFloat(0).toFixed(2));
    $("#id_clifreventaPp").val("");
    $("#id_clifreventaPp").trigger("change");
    $("#id_ventaglobal").val(id_ventas);
}

function btnSumarcantidadpagada(cantrestante, id_detalle, id_tempventaparte) {
    let cantidadpagada = parseInt($("#cantidadpagada" + id_detalle).val()) + 1;
    console.log(cantidadpagada);
    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_cantpagada.php",
        type: "post",
        data: {
            "cantidad": 1,
            "id_detalle": id_detalle,
            "id_tempventaparte": id_tempventaparte
        },
        dataType: "json",
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function () {
        //$data = respuesta.response;
        //tblCajapagoxpartes.ajax.reload();
        let ncantidad = cantrestante - cantidadpagada; //1
        $("#cantidadrest" + id_detalle).html(ncantidad);

        if (ncantidad > 0) { //1
            $("#cantidadPagar" + id_detalle).html('<button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + id_tempventaparte + ')"><i class="mdi mdi-minus"></i></button><input type="number" class="m-0" style="width: 40px;height: 32px" value="' + cantidadpagada + '" disabled id=cantidadpagada' + id_detalle + '><button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + id_tempventaparte + ');"> <i class="mdi mdi-plus"></i></button>');
        }
        if (ncantidad == 0) {
            $("#cantidadPagar" + id_detalle).html('<button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + id_tempventaparte + ')"><i class="mdi mdi-minus"></i></button><input type="number" class="m-0" style="width: 40px;height: 32px" value="' + cantidadpagada + '" min=1 disabled id=cantidadpagada' + id_detalle + '>');
        }
    })

    setTimeout(() => {
        Calcular();
        calcularVueltoPpartes();
        disabledBtnCancelar();
    }, 100);
}

function btnRestarcantidadpagada(cantrestante, id_detalle, id_tempventaparte) {
    let cantidadpagada = parseInt($("#cantidadpagada" + id_detalle).val()) - 1;

    $.ajax({
        url: "ajax/SessionAjaxCocina/actualizar_cantpagada.php",
        type: "post",
        data: {
            "cantidad": -1,
            "id_detalle": id_detalle,
            "id_tempventaparte": id_tempventaparte
        },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        //tblCajapagoxpartes.ajax.reload();
        //$data = respuesta.response;
        let ncantidad = cantrestante - cantidadpagada;
        $("#cantidadrest" + id_detalle).html(ncantidad);

        if (ncantidad > 0) {
            $("#cantidadPagar" + id_detalle).html('<button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + id_tempventaparte + ')"><i class="mdi mdi-minus"></i></button><input type="number" class="m-0" style="width: 40px;height: 32px" value="' + cantidadpagada + '" disabled id=cantidadpagada' + id_detalle + '><button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + id_tempventaparte + ');"> <i class="mdi mdi-plus"></i></button>');
        }
        if (ncantidad == cantrestante) {
            $("#cantidadPagar" + id_detalle).html('<button type="button" class="btn btn-danger m-0" style="height: 32px; margin-right: 10px!important" onclick="eliminarTempVentaParte(' + id_tempventaparte + ',' + cantrestante + ',' + id_detalle + ')"><i class="fas fa-trash-alt"></i></button><input type="number" class="m-0" style="width: 40px;height: 32px" value="' + cantidadpagada + '" disabled id=cantidadpagada' + id_detalle + '><button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + id_tempventaparte + ');"> <i class="mdi mdi-plus"></i></button>')
        }
    })
    setTimeout(() => {
        Calcular();
        calcularVueltoPpartes();
        disabledBtnCancelar();
    }, 100);
}

function registrarTempVentaPart(cantrestante, id_detalle, id_localplato, id_localbebida, precio_venta) {
    $.ajax({
        type: "post",
        url: "ajax/SessionAjaxCaja/registrar_tempventaparte.php",
        dataType: 'json',
        data: {
            "id_localplato": id_localplato,
            "id_localbebida": id_localbebida,
            "precio_venta": precio_venta
        },

        success: function (respuesta) {
            alertify.success('Se registró la operación');
            $("#cantidadPagar" + id_detalle).html('<button type="button" class="btn btn-danger m-0" style="height: 32px; margin-right: 10px!important" onclick="eliminarTempVentaParte(' + respuesta[0]['id_tempventaparte'] + ',' + cantrestante + ',' + id_detalle + ')"><i class="fas fa-trash-alt"></i></button><input type="number" class="m-0" style="width: 40px;height: 32px" value="0" min=1 disabled id=cantidadpagada' + id_detalle + '><button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpagada(' + cantrestante + ',' + id_detalle + ',' + respuesta[0]['id_tempventaparte'] + ');"> <i class="mdi mdi-plus"></i></button>');

            $("#hddidvparte" + id_detalle).val(respuesta[0]['id_tempventaparte']);
            // console.log(respuesta[0]['id_tempventaparte']);
        }
    });
    setTimeout(() => {
        Calcular();
        calcularVueltoPpartes();
        disabledBtnCancelar();
    }, 100);
}

function eliminarTempVentaParte(id_tempventaparte, cantrestante, id_detalle) {
    $.ajax({
        type: "post",
        url: "ajax/SessionAjaxCaja/registrar_tempventaparte.php",
        dataType: 'json',
        data: "eliminar=" + id_tempventaparte,
        success: function (respuesta) {
            alertify.success('Se elimino correctamente');
            $("#cantidadPagar" + id_detalle).html('<button class="btn btn-success" onclick="registrarTempVentaPart(' + cantrestante + ',' + id_detalle + ',' + respuesta[0]['id_localplato'] + ',' + respuesta[0]['id_localbebida'] + ',' + respuesta[0]['precio_venta'] + ')">Pagar</button><input type="hidden" id="cancelarModal' + id_detalle +'"/>');
        },
        error: function () {
            alertify.error('No se elimino correctamente');
        }
    });
    setTimeout(() => {
        Calcular();
        calcularVueltoPpartes();
        disabledBtnCancelar();
    }, 100);
}

//PAGAR Y VUELTO
function calcularVuelto(modalidad) {
    if (modalidad == 'Presencial') {
        $("#vcajaEdit").val((parseFloat($("#mpcajaEdit").val()) - parseFloat($("#ttlcajaEdit").val())).toFixed(2));
    } else {
        $("#vcajaRecojo").val((parseFloat($("#mpcajaRecojo").val()) - parseFloat($("#ttlcajaRecojo").val())).toFixed(2));
    }
}

$(".montocaja").on("input", function (e) {
    console.log(this.id)
    if (this.id == 'mpcajaEdit') {
        modalidad = 'Presencial';
    } else {
        modalidad = 'Recojo';
    }
    calcularVuelto(modalidad);
});

$(".montocaja").change(function (e) {
    e.preventDefault();
    if (this.id == 'mpcajaEdit') {
        mpagado = $("#mpcajaEdit").val();
    } else {
        mpagado = $("#mpcajaRecojo").val();
    }
    console.log(mpagado);
    $.ajax({
        url: "ajax/SessionAjaxVenta/registrar_mpagadoventa.php",
        type: "post",
        data: {
            "id_venta": $('#id_ventaglobal').val(),
            "monto_pagado": mpagado
        },
        dataType: 'json'
    })
});

function btnImagenPago($id_venta) {
    $.ajax({
        url: "ajax/SessionAjaxPedidoMotorizado/pedidomotorizado_ajax.php",
        type: "post",
        data: "pedidomotoxventa=" + $id_venta,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        console.log(respuesta);
        // $('#carnedsanidad').val($data['id_empleado']);
        // $('#namedocumento').val($data['documento']);
        $('#token').val($data[0]['id_p_motorizado']);
        $('#antiguo').val($data[0]['ruta_imagen']);
        $('#id-venta').val($data[0]['id_venta']);
        if ($data[0]['ruta_imagen'] == "" || $data[0]['ruta_imagen'] == null) {
            $('#archivo').attr('src', 'views/DocumentoSalud/carnet_sanidad.jpg');
        } else {
            $('#archivo').attr('src', 'views/imgmotorizado/' + $data[0]['ruta_imagen']);
        }
    });
}
$('#frmRegistroImagenPago').submit(function (e) {
    e.preventDefault();
    var datos = new FormData(this);
    $.ajax({
        url: "ajax/SessionAjaxPedidoMotorizado/pedidomotorizado_ajax.php",
        type: "post",
        data: datos,
        dataType: 'json',
        contentType: false,
        processData: false,
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.responseJson;
        if ($data == 'adjuntado') {
            toastr.success('Archivo Adjuntado');
            $('form#frmRegistroImagenPago')[0].reset();
            btnImagenPago($('#id-venta').val());
            tblDelivery.ajax.reload();
        } else {
            if ($data == 'error') {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
});

$('#id_clifreventaPp').on('change', function () {
    let data = $('#id_clifreventaPp option:selected').val();
    let datasend = 'id_cliente_frecuenteA=' + data;
    $.ajax({
        url: "ajax/SessionAjaxClientesFre/Clientesfrecuentas.ajax.php",
        type: "post",
        data: datasend,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta2) {
        $data2 = respuesta2;
        if ($data2['descuento'] == null) {
            descuento = "0.00";
            $('#descpartes').val(descuento);
        } else {
            descuento = $data2['descuento'];
            $('#descpartes').val(descuento);
        }
    })
    setTimeout(() => {
        Calcular();
        calcularVueltoPpartes();
    }, 100);

});

function Calcular() {
    total = 0;
    descuento = parseFloat($("#descpartes").val()).toFixed(2);
    $("#tblCajapagoxpartes tbody tr").each(function (idx, fila) {
        precio = parseFloat(fila.children[1].children[0].value).toFixed(2);
        cantidad = 0;
        if (fila.children[4].children[0].innerHTML != "Pagado") {
            if (fila.children[4].children[0].children[0].innerHTML != "Pagar") {
                cantidad = fila.children[4].children[0].children[1].value;
            }
        }
        total += precio * cantidad;
    });
    $("#subttlpartes").val(parseFloat(total).toFixed(2));
    $("#ttlpartes").val(parseFloat(total - descuento).toFixed(2));
}

$('#mppartes').on('input', function () {
    calcularVueltoPpartes();
})

function calcularVueltoPpartes() {
    $('#vpartes').val((parseFloat($('#mppartes').val()) - parseFloat($('#ttlpartes').val())).toFixed(2));
    console.log("calculado");
}

$("#btncpagopartes").on("click", function () {
    if ($("#ttlpartes").val() < 1) {
        alertify.error("No hay platos a pagar");
    } else if ($("#mppartes").val() < 1) {
        alertify.error("Ingrese el monto de pago");
    } else if ($("#vpartes").val() < 0) {
        alertify.error("Verifique el monto de pago");
    } else {

        data = {
            "id_venta": $("#id_ventaglobal").val(),
            "id_cliente_frecuente": $("#id_clifreventaPp").val(),
            "monto_pagado": $("#mppartes").val()
        }

        $.ajax({
            url: "ajax/SessionAjaxCaja/registrar_pagoparte.php",
            type: "post",
            data: data,
            dataType: 'json',
        }).done(function (respuesta) {
            data2 = respuesta.response;
            if (data2 == "vacio") {
                alertify.error("No hay registros en TempVentaParte");
            } else if (data2 == "error") {
                alertify.error("Ocurrio un error al registrar");
            } else if (data2 == "guardado") {
                alertify.success("Se registro correctamente");
                $("#mdlpagarxpartes").modal("hide");
            }
        });
    }
});

$("#btncancelarpagopartes").click(function (e) {
    e.preventDefault();
    $("#mdlpagarxpartes").modal("hide");
});

function disabledBtnCancelar() {
    $.ajax({
        url: "ajax/SessionAjaxCocina/listar_derventa.php",
        type: "POST",
        data: {
            id_venta: id_venta, cajaPresencial: 'cajaPresencial'
        },
        dataType: "json"
    }).done(function (respuesta) {
        let contador = 0;
        for (let i = 0; i < respuesta.length; i++) {
            if (!!document.getElementById("cancelarModal" + respuesta[i]["id_detalle"]) == true) {
                contador += 1;
            }
        }
        if(contador == respuesta.length){
            $("#btncancelarpagopartes").removeAttr("disabled");
        } else{
            $("#btncancelarpagopartes").attr("disabled", "");
        }
        console.log("xd");
    });
}

function mostrarticketporpartes($id_venta) {
    $('#tblticketporparte').DataTable().clear();
    $('#tblticketporparte').DataTable().destroy();
        tblticketporparte =$('#tblticketporparte').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            ajax: {
                url: "ajax/SessionAjaxVenta/listar_ventaparte.php",
                dataSrc:"",
                type: "POST",
                dataSrc:"",
                data: {
                    id_venta: $id_venta,
                },
            },
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ],
            columns: [
                {
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                { 'data': 'fecha_hora_pago' },
                { 'data': 'ticket' }
            ],
            order: [[0, "desc"]]
        });
        tblticketporparte.on('order.dt search.dt', function () {
            tblticketporparte.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }





