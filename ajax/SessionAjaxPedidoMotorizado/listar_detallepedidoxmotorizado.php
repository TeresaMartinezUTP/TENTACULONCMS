<?php
require_once '../../controller/pedidomotorizado_controller.php';
require_once '../../model/pedidomotorizado_model.php';

class listardetallepedidoxmotorizadoajax{

    public function ajaxlistardetallepedidoxmotorizado(){

        $id_venta = $_POST['id_venta'];
        $response = pedidomotorizadocontroller::ctrListarDetallePedidoMotorizado($id_venta);

        echo json_encode($response);
    }

}

$resp = new listardetallepedidoxmotorizadoajax();
$resp->ajaxlistardetallepedidoxmotorizado();