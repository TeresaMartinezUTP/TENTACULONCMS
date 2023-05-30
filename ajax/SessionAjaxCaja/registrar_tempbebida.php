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
                "id_usuario" => $_SESSION['id_usuario'],
                "id_localbebida" => $_POST['id_localbebidaventa'],
                "precio_venta" => $_POST['precioventabedida'],
                "cantidad" => $_POST['cantidad_ventabebida'],
                "total" => $_POST['precioventabedida'] * $_POST['cantidad_ventabebida'],
            );
            $respuesta = ControllerCaja::ctrRegistrarTempventaBebida($datos);
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