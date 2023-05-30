<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';


class EliminardetventaAjax
{
    public function ajaxEliminardetventa()
    {
        if (isset($_POST["id_detEli"])) {
            $id_detalle = $_POST["id_detEli"];
            $respuesta = ControllerCaja::ctrEliminardetVenta($id_detalle);
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

$resp = new EliminardetventaAjax;
$resp->ajaxEliminardetventa();
