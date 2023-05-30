<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class Mostrardatosventaajax
{
    public function ajaxMostrardatosventa()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $response = ControllerCaja::ctrMostrardatosventa($id_usuario);
        if ($response['subtotal']==null){
            $response['subtotal']='0.00';
        }
        if ($response['igv']==null){
            $response['igv']='0.00';
        }
        if ($response['total']==null){
            $response['total']='0.00';
        }
        echo json_encode($response);
    }
}

$resp = new Mostrardatosventaajax();
$resp->ajaxMostrardatosventa();
