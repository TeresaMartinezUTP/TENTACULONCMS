<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class actualizarestadoventaAjax
{
    public function ajaxactualizarestadoventa()
    {
        $id_venta = $_POST['id_venta'];
        $respuesta = ControllerCaja::ctrActualizarestadoventa($id_venta);
        if ($respuesta == "ok") {
            $response = array(
                'response' => 'guardado'
            );
        } else {
            if ($respuesta == "error") {
                $response = array(
                    'response' => 'error'
                );
            }
        }

        echo json_encode($response);
    }
}

$resp = new actualizarestadoventaAjax;
$resp->ajaxactualizarestadoventa();
