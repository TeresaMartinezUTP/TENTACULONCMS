<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class CajaAjax
{
    public function ajaxCaja()
    {
        $id_usuario = $_SESSION['id_usuario'];
        if ($_SESSION['id_local'] != null  && $_SESSION['id_usuario'] != null) {
            $datos = array(
                "id_cliente_frecuente"  => $_POST['id_clifreventa'],
                "id_usuario"            => $_SESSION['id_usuario'],
                "id_mesa"               => $_POST['id_mesaventa'],
                "atencion"              => $_POST['id_atencion'],
                "direccion"             => $_POST['direccioncaja'],
                "telefono"              => $_POST['telefono'],
                "prioridad"              => $_POST['prioridad'],
                "cargo"                 => $_POST['cargo'],
                "nombre_contacto"       => $_POST['nombrereferencia'],
                "id_local"              => $_SESSION['id_local']
            );
            $respuesta = ControllerCaja::ctrRegistrarVenta($datos, $id_usuario);
        } /* else {
            $respuesta = "selectmesa";
        } */

        if ($respuesta == "ok") {   
            $response = array(
                'response' => 'guardado'
            );
        } else if ($respuesta == "vacio") {
            $response = array(
                'response' => 'vacio'
            );
        }/* else if ($respuesta == "selectmesa") {
            $response = array(
                'response' => 'selectmesa'
            );
        } */else if ($respuesta == "ocupado") {
            $response = array(
                'response' => 'ocupado'
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

$resp = new CajaAjax;
$resp->ajaxCaja();
