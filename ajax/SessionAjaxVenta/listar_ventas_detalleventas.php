<?php
require_once '../../controller/venta_controller.php';
require_once '../../model/venta_model.php';
session_start();

class listarVenta_DetalleVentaajax
{
    public function ajaxVenta_DetalleVenta()
    {
        $id_local = $_SESSION['id_local'];
        $response = ControllerVenta::ctrListarVentas_DetalleVentas($id_local);

        echo json_encode($response);
    }
}

$resp = new listarVenta_DetalleVentaajax();
$resp->ajaxVenta_DetalleVenta();
