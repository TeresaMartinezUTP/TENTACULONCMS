<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
class actualizarcantpre
{
    public function ajaxactualizarcantpre()
    {
        if ($_POST["cantidad"] < 0) {
            $response = array(
                'response' => 'error'
            );
            echo json_encode($response);
        } else if ($_POST["cantidad"] >= 0) {
            $id_detalle = $_POST["id_detalle"];
            $cantidad = $_POST["cantidad"];
            $respuesta = ControllerCaja::ctrActualizarcantpreparada($cantidad, $id_detalle);
            $response = array(
                'response' => 'true'
            );

            echo json_encode($response);
        }
    }
}


if (isset($_POST["id_detalle"]) && isset($_POST["cantidad"])) {
    $id_detalle = new actualizarcantpre();
    $cantidad = new actualizarcantpre();
    $id_detalle->id_detalle = $_POST["id_detalle"];
    $cantidad->cantidad = $_POST["cantidad"];
    $id_detalle->ajaxactualizarcantpre();
    $cantidad->ajaxactualizarcantpre();
}
