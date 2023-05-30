<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class CajaUpdateP
{
    public function ajaxCajaUp()
    {
        if ($_SESSION['id_local'] != null  && $_SESSION['id_usuario'] != null) {
            $data = array(
                "prioridad"              => $_POST['prioridad'],
                "id_venta"               => $_POST['id_venta'],
            );
            $respuesta = ControllerCaja::ctrActualizaPrioridadventa($data);
        } /* else {
            $respuesta = "selectmesa";
        } */

        if ($respuesta == "ok") {   
            $response = array(
                'response' => $_POST['prioridad']
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

$resp = new CajaUpdateP;
$resp->ajaxCajaUp();
