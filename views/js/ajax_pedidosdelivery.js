$(document).ready(function () {
    mostrarPedidosDelivery();
});

function mostrarPedidosDelivery() {
    divCards = $("#contenido-cards");
    divCards.html("");
    $.getJSON("ajax/SessionAjaxVenta/listar_ventas_detalleventas.php", function (lista) {
        
        for (let i = 0; i < lista.length; i++) {
            divCards.append(`
                <div class="col-sm-6 col-xl-3 p-2">
                    <div class="card">
                        <form method='post' id='frmPedidoDelivery${i}'>
                            <div class="card-header">
                                <div class="row">
                                    <span class="titlecard-pdelivery"> <i class="fal fa-map-marker-alt"></i>${lista[i]['direccion']}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="width: 100%;padding-bottom: 15px;">
                                    <select class="custom-select pedidosselectmotorizado" id="listarMotorizado${i}" name="id_localemple" required>

                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                            <div>
                            <span class="badge badge-danger">${lista[i]['estado']}</span>
                        </div>
                                <input type='hidden' value=${lista[i]['id_venta']} name='id_ventaE'/>
                                <button type="submit" class="btn btn-success p-2 bd-highlight" id="btnEnviar${i}" onclick="registrarPedidoMotorizado(event, 'frmPedidoDelivery${i}', 'listarMotorizado${i}')">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            `);

            $('#listarMotorizado' + i).html('<option value="" selected disabled>Motorizado</option>');
            $.getJSON("ajax/SessionAjaxEmpleado/listar_motorizado.php", function (respuesta) {
                for (let x = 0; x < respuesta.length; x++) {
                    $('#listarMotorizado' + i).append(`
                    <option value="${respuesta[x]['id_localemple']}">${respuesta[x]['nombres']}</option>
                `)
                }
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajax/SessionAjaxVenta/listar_estado_detalleventa.php",
                data: "id_venta=" + lista[i]['id_venta'],
                success: function (respuesta) {                    
                    if(respuesta[0]!=null ){
                        if (respuesta[0]['estado'] == "En proceso") {
                            $("#btnEnviar" + i).attr("disabled", "");
                            setTimeout(() => {
                                $("#listarMotorizado" + i).val(respuesta[0]['id_localemple']);
                            }, 500);
                            $("#listarMotorizado" + i).attr("disabled", "");
                        }
                    }                    
                },
                error: function () {
                    toastr.error('Ocurrió un error');
                }
            });
        }
    });
}

function registrarPedidoMotorizado(e, form, select) {
    e.preventDefault();
    if ($("#" + select).val() == "" || $("#" + select).val() == null) {
        toastr.error('Seleccione un motorizado');
    } else {
        let data = $("#" + form).serialize();

        $.ajax({
            type: "POST",
            url: "ajax/SessionAjaxPedidoMotorizado/pedidomotorizado_ajax.php",
            data: data,
            success: function () {
                toastr.success('Se envió el pedido');
            },
            error: function () {
                toastr.error('Ocurrió un error');
            }
        })
        setTimeout(function () {
            mostrarPedidosDelivery();
        }, 50)
    }
}
$('#selectsedeAdminPE').on('change', function () {
    let $data = $('#selectsedeAdminPE').val();
    $('#tbl_pedidosentregados').DataTable().clear();
    $('#tbl_pedidosentregados').DataTable().destroy();
    tblpedidosentregados = $('#tbl_pedidosentregados').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxPedidosEntregados/listar_pedidos_entregados.php",
            type: "post",
            data: {
                sede: $data,
            },
            dataSrc: '',
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'id_venta' },
            { 'data': 'cliente' },
            { 'data': 'nombres' },
            { 'data': 'pm_estado' },
            { 'data': 'descripcion' },
            { 'data': 'pm_descripcion'},
            { 'data': 'fecha_hora'},
            { 'data': 'detalle' }
        ],
        order: [[0, "desc"]]
    })
})

