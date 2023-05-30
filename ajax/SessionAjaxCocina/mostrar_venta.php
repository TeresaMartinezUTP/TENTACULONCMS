<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class Mostrarventaajax
{
    public function ajaxMostrarventa()
    {
        $id_venta = $_POST['id_venta'];
        $response = ControllerCaja::ctrMostrarVenta($id_venta);
        echo json_encode($response);
    }
}

$resp = new Mostrarventaajax();
$resp->ajaxMostrarventa();
