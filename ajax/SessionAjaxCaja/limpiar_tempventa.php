<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();


class LimpiarTempventaAjax
{
    public function ajaxLimpiarTempventa()
    {
        if (isset($_POST["id_mesaLimp"])) {
            $id_usuario = $_SESSION["id_usuario"];
            $respuesta = ControllerCaja::ctrLimpiarTempVenta($id_usuario);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'limpiado'
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

$resp = new LimpiarTempventaAjax;
$resp->ajaxLimpiarTempventa();
