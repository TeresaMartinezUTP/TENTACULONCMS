<?php
require_once '../../controller/venta_controller.php';
require_once '../../model/venta_model.php';
session_start();

class listarEstado_DetalleVentaajax
{
    public function ajaxEstado_DetalleVenta()
    {
        $id_venta = $_POST["id_venta"];
        $response = ControllerVenta::ctrListarEstadoDetalleVentaxIdVenta($id_venta);

        echo json_encode($response);
    }
}

$resp = new listarEstado_DetalleVentaajax();
$resp->ajaxEstado_DetalleVenta();
