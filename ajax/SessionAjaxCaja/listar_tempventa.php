<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class listarTempventaajax
{
    public function ajaxTempventaListar()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $response = ControllerCaja::ctrListarTablaTempventa($id_usuario);

        for ($i = 0; $i < count($response); $i++) {
            if ($response[$i]['id_localplato'] != null && $response[$i]['id_localbebida'] == null) {
                $response[$i]['nombre_producto'] = '<tr>' . $response[$i]['nombre_plato'] . '</tr>';
            } else  if ($response[$i]['id_localplato'] == null && $response[$i]['id_localbebida'] != null) {
                $response[$i]['nombre_producto'] = '<tr>' . $response[$i]['marca'] . ' ' . $response[$i]['descripcion'] . '</tr>';
            }
            if ($response[$i]['cantidad'] == 1) {
                $response[$i]['cantidades'] = '
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidad'] . ' min=1 disabled>
                <button type="button" class="btn btn-success m-0" onclick="btnSumarTotalVenta(' . ((int)$response[$i]['cantidad'] + 1) . ',' . $response[$i]['id_temp'] . ');"> <i class="mdi mdi-plus"></i></button>
                ';
            } else {
                $response[$i]['cantidades'] = '
                <button type="button" class="btn btn-danger m-0" onclick="btnRestarTotalVenta(' . ((int)$response[$i]['cantidad'] - 1) . ',' . $response[$i]['id_temp'] . ');"> <i class="mdi mdi-minus"></i></button>
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidad'] . ' min=1 disabled>
                <button type="button" class="btn btn-success m-0" onclick="btnSumarTotalVenta(' . ((int)$response[$i]['cantidad'] + 1) . ',' . $response[$i]['id_temp'] . ');"> <i class="mdi mdi-plus"></i></button>
                ';
            }

            $response[$i]['acciones'] = '
                    <td>
                    <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarTemp(' . $response[$i]['id_temp'] . ')"> <i class="mdi mdi-trash-can-outline"></i></button>
                    </td>';
        }

        echo json_encode($response);
    }
}

$resp = new listarTempventaajax();
$resp->ajaxTempventaListar();
