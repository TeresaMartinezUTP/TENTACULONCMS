<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class PagoParteAjax
{
    public function ajaxPagoparte()
    {
        $id_usuario = $_SESSION["id_usuario"];
        $datos = array(
            "id_venta" => $_POST["id_venta"],
            "id_cliente_frecuente" => $_POST["id_cliente_frecuente"],
            "monto_pagado" => $_POST["monto_pagado"]
        );
        
        $respuesta = ControllerCaja::ctrRegistrarPagoParte($datos, $id_usuario);

        if ($respuesta == "ok") {
            $response = array(
                'response' => 'guardado'
            );
        } else if ($respuesta == "vacio") {
            $response = array(
                'response' => 'vacio'
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

$resp = new PagoParteAjax;
$resp->ajaxPagoparte();
