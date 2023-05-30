const buscarPlato = document.querySelector('#buscarPlato');
const btnBuscarPlato = document.querySelector('#btnBuscarPlato');
$IngresoPro = $('#btnIngresoPro');
$EgresoPro = $('#btnEgresoPro');
seccplato = $('#seccplato');
seccbebida = $('#seccbebida');

const BuscarP = () => {
}
$(document).ready(function () {
    catalago = $('#bPlato');
    catalago.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxBuscar/BuscarAjax.php",
        data: "nombre=" + "",
        dataType: 'json',
    }).done(function (respuesta) {
        mostrardatosventa();
        $plato = respuesta;
        for (let i = 0; i < $plato.length; i++) {
            $imagen = $plato[i]['imagen'];
            catalago.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='plato'>
                    <img class="card-img-top" height="130" src="views/imgplato/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$plato[i]['nombre_plato']}</span>
                        <h5 class="card-title">S/ ${$plato[i]['precio']} </h5>
                        <form method="post" id='frmplato${i}'>
                            <input type="hidden" name="id_localplatoventa" id="id_localplatoventa" value="${$plato[i]['id_plato']}">
                            <input type="hidden" name="precioventa" id="precioventa" value="${$plato[i]['precio']}">
                            <input type="hidden" name="cantidad_venta" id="cantidad_venta" value="1">
                            
                            <button class="btn btn-primary" value="Agregar" type="submit"> Agregar </button>
                            
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmplato' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCaja/registrar_tempventa.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa();
                        tblcaja.ajax.reload();
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

});

function BuscarPlatos() {
    const buscarPlato = document.querySelector('#buscarPlato');
    catalago = $('#bPlato');
    catalago.html("");
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
            catalago.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='plato'>
                    <img class="card-img-top" height="130" src="views/imgplato/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$plato[i]['nombre_plato']}</span>
                        <h5 class="card-title">S/ ${$plato[i]['precio']} </h5>
                        <form method="post" id='frmplato${i}'>
                            <input type="hidden" name="id_localplatoventa" id="id_localplatoventa" value="${$plato[i]['id_plato']}">
                            <input type="hidden" name="precioventa" id="precioventa" value="${$plato[i]['precio']}">
                            <input type="hidden" name="cantidad_venta" id="cantidad_venta" value="1">
                            
                            <button class="btn btn-primary" value="Agregar" type="submit"> Agregar </button>
                            
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmplato' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCaja/registrar_tempventa.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa();
                        tblcaja.ajax.reload();
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

function MostrarPlatos() {
    seccplato.removeClass('d-none');
    seccbebida.addClass('d-none');
    catalago = $('#bPlato');
    catalago.html("");
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
            catalago.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='plato'>
                    <img class="card-img-top" height="130" src="views/imgplato/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$plato[i]['nombre_plato']}</span>
                        <h5 class="card-title">S/ ${$plato[i]['precio']} </h5>
                        <form method="post" id='frmplato${i}'>
                            <input type="hidden" name="id_localplatoventa" id="id_localplatoventa" value="${$plato[i]['id_plato']}">
                            <input type="hidden" name="precioventa" id="precioventa" value="${$plato[i]['precio']}">
                            <input type="hidden" name="cantidad_venta" id="cantidad_venta" value="1">
                            
                            <button class="btn btn-primary" value="Agregar" type="submit"> Agregar </button>
                            
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmplato' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCaja/registrar_tempventa.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa();
                        tblcaja.ajax.reload();
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
function MostrarBebidas() {
    seccbebida.removeClass('d-none');
    seccplato.addClass('d-none');
    catalago1 = $('#bBebida');
    catalago1.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxBuscar/BuscarBebidaAjax.php",
        data: "descripcion=" + "",
        dataType: 'json',
    }).done(function (respuesta) {
        $bebida = respuesta;
        for (let i = 0; i < $bebida.length; i++) {
            $imagen = "default.jpg";
            if ($bebida[i]['ruta_imagen'] != "") {
                $imagen = $bebida[i]['ruta_imagen'];
            }
            catalago1.append(`
            <br />
            <div class='col-sm-6 col-xl-4 p-1'>
                <div class='card text-center' id='bebida'>
                    <img class="card-img-top" height="130" src="views/imgbebida/${$imagen}" style="object-fit: cover;">
                    <div class="card-body p-2" style="height: 7rem;">
                        <span> ${$bebida[i]['descripcion']} </span>
                        <h5 class="card-title">S/ ${$bebida[i]['precio']} </h5>
                        <form id='frmbebidaventa${i}' method="post">
                            <input type="hidden" name="id_localbebidaventa" id="id_localbebidaventa" value="${$bebida[i]['id_bebida']}">
                            <input type="hidden" name="precioventabedida" id="precioventabedida" value="${$bebida[i]['precio']}">
                            <input type="hidden" name="cantidad_ventabebida" id="cantidad_ventabebida" value="1">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit"> Agregar </button>
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmbebidaventa' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCaja/registrar_tempbebida.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa();
                        tblcaja.ajax.reload();
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



function BuscarBebidas() {
    const buscarBebida = document.querySelector('#buscarBebida');
    catalago1 = $('#bBebida');
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
                        <form id='frmbebidaventa${i}' method="post">
                            <input type="hidden" name="id_localbebidaventa" id="id_localbebidaventa" value="${$bebida[i]['id_bebida']}">
                            <input type="hidden" name="precioventabedida" id="precioventabedida" value="${$bebida[i]['precio']}">
                            <input type="hidden" name="cantidad_ventabebida" id="cantidad_ventabebida" value="1">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit"> Agregar </button>
                        </form>
                    </div>
                </div>
            </div>
            `);
            $('form#frmbebidaventa' + i).submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                datos = $form.serialize();
                $.ajax({
                    url: "ajax/SessionAjaxCaja/registrar_tempbebida.php",
                    type: "post",
                    data: datos,
                    dataType: 'json',
                }).done(function (respuesta) {
                    $data = respuesta.response;
                    if ($data == 'guardado') {
                        mostrardatosventa();
                        tblcaja.ajax.reload();
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

function btnEliminarTemp(id_tempEli) {
    $.ajax({
        url: "ajax/SessionAjaxCaja/eliminar_tempventa.php",
        type: "post",
        data: "id_tempEli=" + id_tempEli,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa();
        $data = respuesta.response;
        tblcaja.ajax.reload();
    })
}

function btnLimpiarTemp() {
    $.ajax({
        url: "ajax/SessionAjaxCaja/limpiar_tempventa.php",
        type: "post",
        data: "id_mesaLimp",
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa();
        $("#crgcaja").val("0.00")
        $data = respuesta.response;
        tblcaja.ajax.reload();
    })
}


function btnSumarTotalVenta(cantidad, id_temp) {
    $.ajax({
        url: "ajax/SessionAjaxCaja/actualizar_total.php",
        type: "post",
        data: { "cantidad": cantidad, "id_temp": id_temp },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa();
        $data = respuesta.response;
        tblcaja.ajax.reload();
    })
}
function btnRestarTotalVenta(cantidad, id_temp) {
    $.ajax({
        url: "ajax/SessionAjaxCaja/actualizar_total.php",
        type: "post",
        data: { "cantidad": cantidad, "id_temp": id_temp },
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        mostrardatosventa();
        tblcaja.ajax.reload();
        $data = respuesta.response;
    })
}

function mostrardatosventa() {
    datosventa = $('#tabladatosventa');
    datosventa.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxCaja/mostrar_datosventa.php",
        data: "",
        dataType: 'json',
    }).done(function (respuesta) {
        $data = respuesta;

        cargo = 0.00;
        if($("#crgcaja").val() != ""){
            cargo = parseFloat($("#crgcaja").val());
        }

        $('#subttlcaja').val($data['subtotal']);
        //$('#igvcaja').val($data['igv']);
        $('#ttlcaja').val((parseFloat($data['subtotal']) + cargo).toFixed(2));
        $('#id_clifreventa').on('change', function () {
            let data = $('#id_clifreventa option:selected').val();
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
                    $('#subttlcaja').val($data['subtotal']);
                    //$('#igvcaja').val($data['igv']);
                    $('#desccaja').val(descuento);
                    $('#ttlcaja').val((parseFloat($data['subtotal']) + cargo).toFixed(2));
                } else {
                    descuento = $data2['descuento'];
                    $('#subttlcaja').val($data['subtotal']);
                    //$('#igvcaja').val($data['igv']);
                    $('#desccaja').val(descuento);
                    //$('#ttlcaja').val(($data['subtotal'] - descuento).toFixed(2));
                    $('#ttlcaja').val(((parseFloat($data['subtotal']) + cargo) - descuento).toFixed(2));
                }
            });
        });
        if (!!document.getElementById("ListarCaja") == true) {
            $('#id_clifreventa').trigger('change');
        }
        if(!!document.getElementById("ListarCajaedit") == true){
            $('#id_clifreventaEdit').trigger('change');
        }
    });
}

$('form#frmgenerarventa').submit(function (e) {
    e.preventDefault();
    var $form = $(this);
    datos = $form.serialize();
    $.ajax({
        url: "ajax/SessionAjaxCaja/caja_ajax.php",
        type: "post",
        data: datos,
        dataType: 'json',

    }).done(function (respuesta) {
        $data = respuesta.response;
        if ($data == 'guardado') {
            toastr.success('Enviado a cocina');
            $(".js-example-basic-single").val(null).trigger('change');
            $('form#frmgenerarventa')[0].reset();
            btnLimpiarTemp();
            $('#id_atencion').trigger('change');
        } else if ($data == 'vacio') {
            toastr.warning('No se puede recepcionar con datos vacios');
        } else if ($data == 'selectmesa') {
            alertify.notify('Seleccione la mesa', 'notify');
        } else if ($data == 'ocupado') {
            toastr.info('Mesa ocupada');
        } else {
            if ($data == 'error') {
                swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
});

$('#id_atencion').on('change', function () {
    $tipo_atencion = $('#id_atencion').val();
    if ($tipo_atencion == 'Delivery') {
        $('#mesacaja').attr('hidden', true);
        $('#seccioncaja').attr('hidden', false);
        $('#id_mesaventa').attr('required', false);
        $('#direccioncaja').attr('required', true);
        $('#telefonocaja').attr('hidden', false);
        $('#telefono').attr('required', true);
        $('#telefono').val('');
        $(".js-example-basic-single").val(null).trigger('change');
        $('#referenciacaja').attr('hidden', false);
        $('#nombrereferencia').attr('required', true);
        $("#seccCargo").attr('hidden', false);
        $("#seccCargo").attr('required', true);
        $("#secc-clifre").attr('hidden', false);
        $("#descajatr").attr('hidden', false);
    } else if ($tipo_atencion == 'Recojo') {
        $('#mesacaja').attr('hidden', true);
        $('#seccioncaja').attr('hidden', true);
        $('#id_mesaventa').attr('required', false);
        $('#direccioncaja').attr('required', false);
        $('#direccioncaja').val('');
        $('#telefonocaja').attr('hidden', false);
        $('#telefono').attr('required', true);
        $('#telefono').val('');
        $(".js-example-basic-single").val(null).trigger('change');
        $('#referenciacaja').attr('hidden', false);
        $('#nombrereferencia').attr('required', true);
        $("#seccCargo").attr('hidden', true);
        $("#seccCargo").attr('required', false);
        $("#secc-clifre").attr('hidden', false);
        $("#descajatr").attr('hidden', false);
    } else {
        if ($tipo_atencion == 'Presencial') {
            $('#mesacaja').attr('hidden', false);
            $('#seccioncaja').attr('hidden', true);
            $('#id_mesaventa').attr('required', true);
            $('#direccioncaja').attr('required', false);
            $('#direccioncaja').val('');
            $('#telefonocaja').attr('hidden', true);
            $('#telefono').val('');
            $('#telefono').attr('required', false);
            $(".js-example-basic-single").val(null).trigger('change');
            $('#referenciacaja').attr('hidden', true);
            $('#nombrereferencia').attr('required', false);
            $('#nombrereferencia').val('');
            $("#seccCargo").attr('hidden', true);
            $("#seccCargo").attr('required', false);
            $("#secc-clifre").attr('hidden', true);
            $("#descajatr").attr('hidden', true);
        }
    }
});

$("#crgcaja").on("input", function (e) {
    e.preventDefault();
    mostrardatosventa();
});