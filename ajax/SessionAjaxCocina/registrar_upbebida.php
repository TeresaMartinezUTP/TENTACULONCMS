<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class TempventaBebidaAjax
{
    public function ajaxTempventaBebida()
    {
        if ($_POST['precioventabedida'] != null  && $_POST['cantidad_ventabebida'] != null) {
            $datos = array(
                "id_venta" => $_POST['id_venta_bebida'],
                "id_localbebida" => $_POST['id_localbebidaventa'],
                "precio_venta" => $_POST['precioventabedida'],
                "cantidad" => $_POST['cantidad_ventabebida'],
                "total" => $_POST['precioventabedida'] * $_POST['cantidad_ventabebida'],
            );
            $respuesta = ControllerCaja::ctrRegistrarupventaBebida($datos);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'guardado'
                );
            } else if ($respuesta == "repeat") {
                $response = array(
                    'response' => 'repeat'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        }
        echo json_encode($response);
    }
}

$resp = new TempventaBebidaAjax;
$resp->ajaxTempventaBebida();