<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class CajaupAjax
{
    public function ajaxupCaja()
    {
        if ($_POST['id_mesaventa'] != null) {
            $datos = array(
                "id_cliente_frecuente" => $_POST['id_clifreventa'],
                "id_mesa" => $_POST['id_mesaventa'],
                "id_venta" => $_POST['id_venta']
            );
            $respuesta = ControllerCaja::ctrActualizarVenta($datos);
        }

        if ($respuesta == "ok") {
            $response = array(
                'response' => 'guardado'
            );
        }else {
            if ($respuesta == "error") {
                $response = array(
                    'response' => 'error'
                );
            }
        }

        echo json_encode($response);
    }
}

$resp = new CajaupAjax;
$resp->ajaxupCaja();
