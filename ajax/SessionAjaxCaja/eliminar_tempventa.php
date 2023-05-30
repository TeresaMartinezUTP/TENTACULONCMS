<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';


class EliminarTempventaAjax
{
    public function ajaxEliminarTempventa()
    {
        if (isset($_POST["id_tempEli"])) {
            $id_temp = $_POST["id_tempEli"];
            $respuesta = ControllerCaja::ctrEliminarTempVenta($id_temp);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'eliminado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        } else {
            $response = array(
                'response' => 'error'
            );
        }
        echo json_encode($response);
    }
}

$resp = new EliminarTempventaAjax;
$resp->ajaxEliminarTempventa();
