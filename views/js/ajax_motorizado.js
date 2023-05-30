$(document).ready(function () {
    listarPedidoxMotorizado();
});

function listarPedidoxMotorizado() {
    $.getJSON("ajax/SessionAjaxPedidoMotorizado/listar_pedidoxmotorizado.php", function (lista) {
        PintarPedidoxMotorizado(lista,);
    });
}

function PintarPedidoxMotorizado(lista) {
    divCardsM = $("#divCardsM");
    divCardsM.html("");
    for (let i = 0; i < lista.length; i++) {
        divCardsM.append(`
            <div class="col-sm-12 col-md-4 px-0">
                <div class="card card-M m-2">
                    <div class="card-header">
                        <div class="row justify-content-end align-items-center">
                            <h4 class="col-9 m-0" data-toggle="collapse" href="#collapseMoto${i}" role="button" aria-expanded="false">Nº Pedido: ${lista[i]['id_p_motorizado']}</h4>
                            <div class="col-3" style="text-align: end;">
                                <button type="button" class="btn btn-warning mdi mdi-alert" onclick="mostrarIncidencia(${lista[i]['id_p_motorizado']})"></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body collapse" id="collapseMoto${i}">
                        <ul class="p-0">
                            <li id=empleado${i}></li>
                            <li><b>Cliente:</b></li>
                            <li>${lista[i]['nombre_contacto']}</li>
                            <li><b>Detalle:</b></li>
                            <li>
                                <table class="table-moto m-auto">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cant.</th>
                                            <th>P/u</th>
                                        </tr>
                                    </thead>
                                    <tbody id=pedido-detalle${i}>
                                        
                                    </tbody>
                                </table>
                            <div class="dropdown-divider"></div>
                            </li>
                            <li id=descuento${i}></li>
                            <li ><b>Cargo:</b></li>
                            <li>${lista[i]['cargo']}</li>
                            <li ><b>Total:</b></li>
                            <li id=total${i}></li>
                            <li><b>Dirección:</b></li>
                            <li>${lista[i]['direccion']}</li>
                            <li><b>N° Celular:</b></li>
                            <li>${lista[i]['telefono']}</li>
                            <li><b>Hora de Pedido:</b></li>
                            <li>${lista[i]['fecha_hora']}</li>
                        </ul>
                        <form onsubmit="confirmarEntrega(event, ${i})" type="post" id="frmEntregado${i}" enctype="multipart/form-data">
                            <div class="item-group pt-4 mb-3 bloque-inferiorM">
                                <input type="hidden" name="id_ventaF" value="${lista[i]['id_venta']}"/>
                                <input type="hidden" name="id_p_motorizadoF" value="${lista[i]['id_p_motorizado']}"/>
                                <input type="hidden" name="estado" id="hdd_estado" value="${lista[i]['estado']}"/>
                                <!-- <div class="mr-3">
                                    <label for="imagenBoleta${i}" id="icon-imageMotorizado${i}" class="btn btn-primary btnmotolabel"><i class="mdi mdi-image-size-select-actual"></i></label>
                                    <span id="icon-cerrarMotorizado${i}"></span>
                                    <input type="file" name="ruta_imagen" id="imagenBoleta${i}" class="d-none" onchange="previewMotorizado(event, ${i})">
                                    <img class="img-fluid my-2" id="img-previewMotorizadoOne${i}">
                                </div>-->
                                <input type="hidden" name="ruta_imagen" class="d-none">
                                <div>
                                    <button class="btn btn-success" type="submit" id="btnEntregado">Confirmar Entrega</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `)
        if (lista[i]['nomemple']!=null) {
            let encar = lista[i]['nomemple'];
            $('#empleado'+i).html(`<b>Encargado:</b></li><li>`+ encar);
        }
        $("#pedido-detalle" + i).html("");
        $.ajax({
            type: "POST",
            url: "ajax/SessionAjaxPedidoMotorizado/listar_detallepedidoxmotorizado.php",
            data: "id_venta=" + lista[i]['id_venta'],
            dataType: 'json',
        }).done(function (respuesta) {
            console.log(respuesta)
            let producto;
            let total = 0.0;
            for (let x = 0; x < respuesta.length; x++) {
                if (respuesta[x]['id_localbebida'] == null) {
                    producto = respuesta[x]['nombre_plato'];
                } else {
                    producto = respuesta[x]['descripcion'];
                }

                total += respuesta[x]['precio_venta'] * respuesta[x]['cantidad'];

                $("#pedido-detalle" + i).append(`
                <tr>
                    <td>${producto}</td>
                    <td>${respuesta[x]['cantidad']}</td>
                    <td>${respuesta[x]['precio_venta']}</td>
                </tr>
                `)
            }
            if (respuesta[0]['descuento']!=null) {
                let descuento = respuesta[0]['descuento'];
                $('#descuento'+i).html(`<b>Descuento:</b></li><li>S/. `+ descuento);
                total-=descuento;
            }else{
                $('#descuento').html("");
            }
            $("#total" + i).html("S/. " + (parseFloat(total) + parseFloat(lista[i]['cargo'])).toFixed(2));
        });
    }
}
function mostrarIncidencia(id_p_motorizado) {
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxPedidoMotorizado/pedidomotorizado_ajax.php",
        data: "id_p_motorizadoR=" + id_p_motorizado,
        dataType: 'json',
    }).done(function (respuesta) {
        for (x = 0; x < respuesta.length; x++) {
            $("#hddid").val(respuesta[x]['id_p_motorizado']);
            $("#hddid_venta").val(respuesta[x]['id_venta']);
            // $("#hddestado").val(respuesta[x]['estado']);
            // $("#hddruta_imagen").val(respuesta[x]['ruta_imagen']);
            // $("#select-incidencia").val(respuesta[x]['id_incidencia']);
            // $("#txtDescripcion").val(respuesta[x]['descripcion']);
        }
        $("#mdlIncidencia").modal("show");
    })
}

$(document).on("submit", "#frmIncidencia", function (e) {
    e.preventDefault();
    if ($("#select-incidencia").val() == "" || $("#select-incidencia").val() == null) {
        toastr.error('Debe seleccionar una incidencia');
    } else {
        $("#hddestado").val("Finalizado por Incidencia");
        data = $("#frmIncidencia").serialize();
        $.ajax({
            type: "POST",
            url: "ajax/SessionAjaxPedidoMotorizado/pedidomotorizado_ajax.php",
            data: data,
            dataType: 'json',
        }).done(function (respuesta) {
            if (respuesta.responseJson == "actualizado") {
                toastr.info('Incidencia registrada correctamente');
                listarPedidoxMotorizado();
            } else {
                toastr.error('Ocurrió un error');
            }
        })
        $("#mdlIncidencia").modal("hide");
    }
});

function confirmarEntrega(e, i) {
    e.preventDefault();
        Swal.fire({
            title: 'Confirmar',
            text: "¿Está seguro que desea confirmar la entrega?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#hdd_estado").val("Entregado");
                form = document.getElementById("frmEntregado" + i); 
                data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "ajax/SessionAjaxPedidoMotorizado/pedidomotorizado_ajax.php",
                    data: data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                }).done(function (respuesta) {
                    if (respuesta.responseJson == "actualizado") {
                        toastr.info('Pedido finalizado correctamente');
                        listarPedidoxMotorizado();
                    } else {
                        toastr.error('Ocurrió un error');
                    }
                });
            } else {
                Swal.fire("Cancelado", "Canceló la operación", "info");
            }
        });
    
};
$('#selectsedeAdminM').on('change', function () {
    let $sede = $('#selectsedeAdminM').val();
    console.log($sede);
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxPedidoMotorizado/listar_pedidoxmotorizado.php",
        data: "sede=" + $sede,
        dataType: 'json',
    }).done(function (respuesta) {
        PintarPedidoxMotorizado(respuesta);
    });
})
