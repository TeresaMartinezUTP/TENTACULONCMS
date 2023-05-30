<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
class actualizartotal
{
    public function ajaxactualizartotal()
    {
        if ($_POST["cantidad"] < 1) {
            $response = array(
                'response' => 'error'
            );
            echo json_encode($response);
        } else if ($_POST["cantidad"] >= 1) {
            $id_temp = $_POST["id_temp"];
            $cantidad = $_POST["cantidad"];
            $respuesta = ControllerCaja::ctrActualizarTotalTempVenta($cantidad, $id_temp);
            $response = array(
                'response' => 'true'
            );

            echo json_encode($response);
        }
    }
}


if (isset($_POST["id_temp"]) && isset($_POST["cantidad"])) {
    $id_temp = new actualizartotal();
    $cantidad = new actualizartotal();
    $id_temp->id_temp = $_POST["id_temp"];
    $cantidad->cantidad = $_POST["cantidad"];
    $id_temp->ajaxactualizartotal();
    $cantidad->ajaxactualizartotal();
}
