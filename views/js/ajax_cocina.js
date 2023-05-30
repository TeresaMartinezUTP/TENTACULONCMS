$(document).ready(function () {
    mostrarordenes();
    mostrarordenesprioritarias();
});

function mostrarordenes() {
    divcocina = $('#divcocina');
    divcocina.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxCocina/listar_ordenes.php",
        data: { todasVentas: 'todasVentas' },
        dataType: 'json',
    }).done(function (respuesta) {
        $ordenes = respuesta;
        for (let i = 0; i < $ordenes.length; i++) {
            if ($ordenes[i]['nombre_mesa'] != null) {
                $modopedido = $ordenes[i]['nombre_mesa'];
            } else {
                $modopedido = $ordenes[i]['atencion'];
            }
            divcocina.append(
                `<div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 p-2">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-5">
                                <h6 class="m-0">${$modopedido.toUpperCase()}</h6>
                            </div>
                            <div class="col-7" style="text-align: end;">
                                <h6 class="m-0">${$ordenes[i]['fecha_hora']}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table-detalle container-fluid">
                            <tbody id="detordencocina${i}">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            `
            );

            $('#detordencocina' + i).html("");
            $.ajax({
                type: "POST",
                url: "ajax/SessionAjaxCocina/listar_detordenes.php",
                data: {atencion: $ordenes[i]['atencion'],
                id_mesa: $ordenes[i]['id_mesa'],
                id_venta: $ordenes[i]['id_venta']},
                dataType: 'json',
            }).done(function (respuesta) {
                $detordenes = respuesta;
                for (let f = 0; f < $detordenes.length; f++) {
                    let nombre = "";
                    if ($detordenes[f]['nombre_plato'] == null) {
                        nombre = $detordenes[f]['descripcion'];
                    } else {
                        nombre = $detordenes[f]['nombre_plato'];

                    }
                    $cantidadrestante = $detordenes[f]['cantidad'] - $detordenes[f]['cantidadcocinada'];
                    if ($cantidadrestante > 0) {
                        $clase = "badge badge-danger";
                        $estadodvcocina = "Pendiente";
                        $remover = ""
                    } else {
                        $clase = "badge badge-success";
                        $estadodvcocina = "Entregado";
                        $remover = "d-none"
                    }
                    $('#detordencocina' + i).append(
                        `<tr>
                            <td>${nombre}</td>
                            <td>
                                <span class="${$remover}">${$detordenes[f]['cantidad'] - $detordenes[f]['cantidadcocinada']}</span>
                            </td>
                            <td><span class="${$clase}">${$estadodvcocina}</span></td>
                        </tr>
                        `

                    );
                }
            });
        }
    });
}

function mostrarordenesprioritarias() {
    divprioritario = $('#divprioritario');
    divprioritario.html("");
    $.ajax({
        type: "POST",
        url: "ajax/SessionAjaxCocina/listar_ordenes.php",
        data: { prioritario: 'prioritario'},
        dataType: 'json',
    }).done(function (respuesta) {
        $rpt = respuesta;
        for (let i = 0; i < $rpt.length; i++) {
            if ($rpt[i]['nombre_mesa'] != null) {
                $modo = $rpt[i]['nombre_mesa'];
            } else {
                $modo = $rpt[i]['atencion'];
            }
            divprioritario.append(
                `<div class="col-sm-6 col-md-12 p-2">
                <div class="card border border-warning h-100" style="border-width: 3px!important;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-5">
                                <h6 class="m-0">${$modo.toUpperCase()}</h6>
                            </div>
                            <div class="col-7" style="text-align: end;">
                                <h6 class="m-0">${$rpt[i]['fecha_hora']}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table-detalle container-fluid">
                            <tbody id="detordencocinaxid${i}">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            `
            );

            $('#detordencocinaxid' + i).html("");
            $.ajax({
                type: "POST",
                url: "ajax/SessionAjaxCocina/listar_detordenes.php",
                data: {atencion: $rpt[i]['atencion'],
                id_mesa: $rpt[i]['id_mesa'],
                id_venta: $rpt[i]['id_venta']},
                dataType: 'json',
            }).done(function (respuesta) {
                $detalle = respuesta;
                for (let f = 0; f < $detalle.length; f++) {
                    let nombre = "";
                    if ($detalle[f]['nombre_plato'] == null) {
                        nombre = $detalle[f]['descripcion'];
                    } else {
                        nombre = $detalle[f]['nombre_plato'];

                    }
                    $cantidadrestante = $detalle[f]['cantidad'] - $detalle[f]['cantidadcocinada'];
                    if ($cantidadrestante > 0) {
                        $clase = "badge badge-danger";
                        $estadodvcocina = "Pendiente";
                        $remover = ""
                    } else {
                        $clase = "badge badge-success";
                        $estadodvcocina = "Entregado";
                        $remover = "d-none"
                    }
                    $('#detordencocinaxid' + i).append(
                        `<tr>
                            <td>${nombre}</td>
                            <td>
                                <span class="${$remover}">${$detalle[f]['cantidad'] - $detalle[f]['cantidadcocinada']}</span>
                            </td>
                            <td><span class="${$clase}">${$estadodvcocina}</span></td>
                        </tr>
                        `

                    );
                }
            });
        }
    });
}