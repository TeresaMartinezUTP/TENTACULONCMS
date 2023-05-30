<?php
require_once '../../controller/cocina_controller.php';
require_once '../../model/cocina_model.php';
session_start();

class listardetordenesCocinaajax
{
    public function ajaxCocinalistardetordenes()
    {
        if (isset($_POST['atencion']) && $_POST['atencion'] == "Presencial") { //presencial
            $id_mesa = $_POST['id_mesa'];
            $tabla = "detalle_venta";
            $respuesta = cocinaControlador::ctrListarDetOrdenes($tabla, $id_mesa);
        } else if (isset($_POST['atencion']) && $_POST['atencion'] == "Delivery") { //delivery
            $id_venta = $_POST['id_venta'];
            $tabla = "detalle_venta";
            $respuesta = cocinaControlador::ctrListarDetOrdenesxIdVenta($tabla, $id_venta);
        } else if (isset($_POST['atencion']) && $_POST['atencion'] == "Recojo") { //recojo
            $id_venta = $_POST['id_venta'];
            $tabla = "detalle_venta";
            $respuesta = cocinaControlador::ctrListarDetOrdenesxIdVenta($tabla, $id_venta);
        }

        echo json_encode($respuesta);
    }
}
$resp = new listardetordenesCocinaajax;
$resp->ajaxCocinalistardetordenes();
