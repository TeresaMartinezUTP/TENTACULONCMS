<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();
class actualizaridclifre
{
    public function ajaxactualizaridclifre()
    {

        $id_venta = $_POST["id_venta"];
        $id_clifre = $_POST["id_cliente_frecuenteA"];
        $respuesta = ControllerCaja::ctrActualizarclifrefromventa($id_venta,$id_clifre);

        echo json_encode($respuesta);
    }
}



$resp = new actualizaridclifre();
$resp->ajaxactualizaridclifre();
