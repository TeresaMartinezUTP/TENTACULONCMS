<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
class actualizartotaldet
{
    public function ajaxactualizartotaldet()
    {
        if ($_POST["cantidad"] < 1) {
            $response = array(
                'response' => 'error'
            );
            echo json_encode($response);
        } else if ($_POST["cantidad"] >= 1) {
            $id_detalle = $_POST["id_detalle"];
            $cantidad = $_POST["cantidad"];
            $respuesta = ControllerCaja::ctrActualizarTotaldetVenta($cantidad, $id_detalle);
            $response = array(
                'response' => 'true'
            );

            echo json_encode($response);
        }
    }
}


if (isset($_POST["id_detalle"]) && isset($_POST["cantidad"])) {
    $id_detalle = new actualizartotaldet();
    $cantidad = new actualizartotaldet();
    $id_detalle->id_detalle = $_POST["id_detalle"];
    $cantidad->cantidad = $_POST["cantidad"];
    $id_detalle->ajaxactualizartotaldet();
    $cantidad->ajaxactualizartotaldet();
}
