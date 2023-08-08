function MostrarDetalleVenta(id_venta) {
    $.ajax({
        url: "ajax/SessionAjaxPedidosEntregados/listar_pedidos_entregados_id.php",
        type: "post",
        data: "id_venta=" + id_venta,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        let cliente;
        if ($data[0]['nombre_contacto'] == "") {
            cliente=$data[0]['nombre_completo'];
        }
        else{
            cliente=$data[0]['nombre_contacto'];
        }
        if ($data[0]['pm_estado']=="Entregado") {

            $('#estado').removeClass("badge-danger");
            $('#estado').addClass("badge-success");

        }else {
            $('#estado').removeClass("badge-danger");
            $('#estado').addClass("badge-danger");

        }
        let fecha=$data[0]['fecha_hora'].split(" ")[0];
        let hora_pedido=$data[0]['fecha_hora'].split(" ")[1];
        let hora_entrega=$data[0]['fecha_hora_entrega'].split(" ")[1];
        let cargo = $data[0]['cargo'];

        $('#cliente').html(cliente);
        $('#fecha').html(fecha);
        $('#hora_pedido').html(hora_pedido);
        $('#hora_entrega').html(hora_entrega);
        $('#estado').html($data[0]['pm_estado']);
        $('#cargo').html(cargo);
    });

    $("#pedido_detalle").html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxPedidoMotorizado/listar_detallepedidoxmotorizado.php",
        data: "id_venta=" + id_venta,
        dataType: 'json',
    }).done(function (respuesta) {
        let producto;
        let total = 0.0;
        for (let x = 0; x < respuesta.length; x++) {
            if (respuesta[x]['id_localbebida'] == null) {
                producto = respuesta[x]['nombre_plato'];
            } else {
                producto = respuesta[x]['descripcion'];
            }

            total += respuesta[x]['precio_venta'] * respuesta[x]['cantidad'];

            $("#pedido_detalle").append(`
            <tr>
                <td>${producto}</td>
                <td>${respuesta[x]['cantidad']}</td>
                <td>${respuesta[x]['precio_venta']}</td>
            </tr>
            `)
        }
        if (respuesta[0]['descuento']!=null) {
            let descuento = respuesta[0]['descuento'];
            $('#descuento').html(`<b>Descuento:</b></li><li>S/. `+ descuento);
            total-=descuento;
        }else{
            $('#descuento').html("");
        }
        cargof = respuesta[0]['cargo'];
        $("#total").html("S/. " + (parseFloat(total) + parseFloat(cargof)).toFixed(2));
    });
}