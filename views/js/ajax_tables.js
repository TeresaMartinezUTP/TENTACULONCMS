$(document).ready(function () {
    tablainicio = $('#dataTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
    });

    tblEmpleado = $('#tbl_empleados').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxEmpleado/listar_empleado.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [

            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 },
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        columns: [
            { 'data': 'id_empleado'},
            { 'data': 'nombres' },
            { 'data': 'tipo_doc' },
            { 'data': 'num_doc' },
            { 'data': 'telefono' },
            { 'data': 'correo' },
            { 'data': 'area' },
            { 'data': 'documentos' },
            { 'data': 'estado' },
            { 'data': 'acciones' }
        ],
        order: [[0, "desc"]]
    });

    tblUsuarios = $('#tbl_usuario').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxUsuarios/listar_usuarios.php",
            dataSrc: ''
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
            { 'data': 'rol' },
            { 'data': 'nombres' },
            { 'data': 'correo' },
            { 'data': 'local' },
            { 'data': 'estado' },
            { 'data': 'acciones' }
        ],
        order: [[0, "desc"]]
    });
    tblUsuarios
        .on("order.dt search.dt", function () {
            tblUsuarios
                .column(0, { search: "applied", order: "applied" })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
        })
        .draw();

    tblLocal = $('#tbl_local').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxLocal/listar_locales.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'sede' },
            { 'data': 'direccion' },
            { 'data': 'status' },
            { 'data': 'acciones' }
        ],
        order: [[0, "asc"]]
    });

    tblPostulante = $('#tbl_postulantes').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxPostulante/listar_postulante.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 },
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        columns: [
            { 'data': 'id_postulante' },
            { 'data': 'area' },
            { 'data': 'nombres' },
            { 'data': 'tipo_doc' },
            { 'data': 'num_doc' },
            { 'data': 'telefono' },
            { 'data': 'correo' },
            { 'data': 'documento' },
            { 'data': 'estado' },
            { 'data': 'acciones' }
        ],
        order: [[0, "desc"]]
    });

    tblCategoriaPlato = $('#tbl_categoriaplato').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCategoriaPlatos/listar_categoriaplatos.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'id_categoria' },
            { 'data': 'nombre' },
            { 'data': 'descripcion' },
            {
                'data': "imagen",
                "render": function (data) {
                    return '<img src="views/imgcateplato/' + data + '"  width="50" height="50" />';
                }
            },
            { 'data': 'status' },
            { 'data': 'acciones' }
        ],

    });

    tblPlatos = $('#tbl_platos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxPlatos/listar_platos.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'nombre' },
            { 'data': 'nombre_plato' },
            { 'data': 'descripcion' },
            { 'data': 'precio' },
            {
                'data': "imagen",
                "render": function (data) {
                    return '<img src="views/imgplato/' + data + '"  width="50" height="50" />';
                }
            },
            { 'data': 'status' },
            { 'data': 'acciones' }
        ],
    });

    tblBebidas = $('#tbl_bebidas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxBebidas/listar_bebidas.php",
            dataSrc: ''
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
            { 'data': 'marca' },
            { 'data': 'descripcion' },
            { 'data': 'precio' },
            {
                'data': "ruta_imagen",
                "render": function (data) {
                    return '<img src="views/imgbebida/' + data + ' "  width="50" height="50" />';
                }
            },
            { 'data': 'fecha_registro' },
            { 'data': 'status' },
            { 'data': 'acciones' },
        ],
    });
    tblBebidas
        .on("order.dt search.dt", function () {
            tblBebidas
                .column(0, { search: "applied", order: "applied" })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
        })
        .draw();

    tblLocalBebidas = $('#tbl_localbebidas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxLocalBebidas/listar_localbebidas.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'sede' },
            { 'data': 'bebida' },
            { 'data': 'estado' },
            { 'data': 'acciones' },
        ],
    });

    tblLocalMesa = $('#tableLocalMesas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxLocalMesas/listar_localmesas.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'nombre_mesa' },
            { 'data': 'local' },
            { 'data': 'estado' },
            { 'data': 'acciones' }
        ],
        order: [[0, "desc"]]
    });

    tblPlatoLocal = $('#tbl_localplatos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxLocalPlatos/listar_localplatos.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'sede' },
            { 'data': 'nombre_plato' },
            { 'data': 'estado' },
            { 'data': 'acciones' },
        ]
    });

    tblLocalEmpleado = $('#tbl_localempleado').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxLocalEmpleado/listar_localempleado.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'sede' },
            { 'data': 'empleado' },
            { 'data': 'acciones' },
        ],
        order: [[0, "desc"]]
    });

    tblBebidaInventario = $('#tbl_inventariobebidas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxInventarioBebidas/listar_inventariobebidas.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'bebida' },
            { 'data': 'stock_total' },
            { 'data': 'sede' },
            { 'data': 'stockestado' },
            { 'data': 'estado' },
            { 'data': 'acciones' }
        ],
        order: [[0, "desc"]]

    });
    tblupcaja = $('#tblupcaja').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCocina/listar_ordenes.php",
            type: 'post',
            data: {presencial:'Presencial'},
            dataSrc: '',
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        "ordering": false,

        columns: [
            {
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { 'data': 'nombre_mesa' },
            { 'data': 'fecha_hora' },
            { 'data': 'prioridad' },
            { 'data': 'pendientes' },
            { 'data': 'modificar' },
            { 'data': 'pagarxpartes' },
            { 'data': 'finalizar' }
        ],
    });
    tblupcaja.on('order.dt search.dt', function () {
        tblupcaja.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    tblDelivery = $('#tblDelivery').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCocina/listar_ordenes.php",
            type: 'post',
            data: {delivery:'Delivery'},
            dataSrc: '',
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        "ordering": false,

        columns: [
            {
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { 'data': 'nombre_contacto' },
            { 'data': 'direccion' },
            { 'data': 'telefono' },
            { 'data': 'fecha_hora' },            
            { 'data': 'prioridad' },            
            { 'data': 'imagen' },            
            { 'data': 'pendientes' },            
            { 'data': 'modificar' },
            { 'data': 'voucher' }
        ],
    });
    tblDelivery.on('order.dt search.dt', function () {
        tblDelivery.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    tblRecojo = $('#tblRecojo').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCocina/listar_ordenes.php",
            type: 'post',
            data: {recojo:'Recojo'},
            dataSrc: '',
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        "ordering": false,

        columns: [
            {
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { 'data': 'nombre_contacto' },            
            { 'data': 'telefono' },
            { 'data': 'fecha_hora' },            
            { 'data': 'prioridad' },            
            { 'data': 'pendientes' },
            { 'data': 'modificar' },
            { 'data': 'finalizar' }
        ],
    });
    tblRecojo.on('order.dt search.dt', function () {
        tblRecojo.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    tblventa = $('#tblventa').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxVenta/listar_ventas.php",
            type: 'post',
            data: "",
            dataSrc: '',
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        "ordering": false,

        columns: [
            {
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { 'data': 'atencion' },
            { 'data': 'fecha_hora' },
            { 'data': 'ticket' }
        ],
    });
    tblventa.on('order.dt search.dt', function () {
        tblventa.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    tblBebidaInventarioH = $('#tableBebidaInventario').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxInventarioBebidas/listar_bebidastock.php",
            dataSrc: ''
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        columns: [
            { 'data': 'sede' },
            { 'data': 'bebida' },
            { 'data': 'stock' },
            { 'data': 'fecha' },
            { 'data': 'acciones' },
        ],
        order: [[3, "desc"]]
    });

    tblcaja = $('#ListarCaja').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxCaja/listar_tempventa.php",
            type: 'post',
            data: "",
            dataSrc: '',
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
    tblclientesfre =$('#tblclientefre').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxClientesFre/listar_clientesfrecuentes.php",
            type: 'post',
            data: "",
            dataSrc: '',
        },
        //'sDom': 't',
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
            { 'data': 'id_cliente_frecuente' },
            { 'data': 'nombre_completo' },
            { 'data': 'telefono' },
            { 'data': 'correo' },
            { 'data': 'descuento' },
            { 'data': 'sede' },
            { 'data': 'estado' },
            { 'data': 'acciones' }
        ],
    });

    tblpedidosentregados =$('#tbl_pedidosentregados').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        ajax: {
            url: "ajax/SessionAjaxPedidosEntregados/listar_pedidos_entregados.php",
            
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
    });
});


