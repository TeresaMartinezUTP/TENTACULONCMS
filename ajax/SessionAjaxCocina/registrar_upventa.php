<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class TempventaAjax
{
    public function ajaxTempventa()
    {
        if ($_POST['precioventa'] != null  && $_POST['cantidad_venta'] != null) {
            $datos = array(
                "id_venta" => $_POST['id_venta_venta'],
                "id_localplato" => $_POST['id_localplatoventa'],
                "precio_venta" => $_POST['precioventa'],
                "cantidad" => $_POST['cantidad_venta'],
                "total" => $_POST['precioventa'] * $_POST['cantidad_venta'],
            );
            $respuesta = ControllerCaja::ctrRegistrarUpventa($datos);
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

$resp = new TempventaAjax;
$resp->ajaxTempventa();
