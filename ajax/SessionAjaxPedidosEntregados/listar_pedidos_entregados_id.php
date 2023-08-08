<?php
require_once '../../controller/pedidomotorizado_controller.php';
require_once '../../model/pedidomotorizado_model.php';

session_start();
class listarPedidosEntregadosporId{

    public function ajaxlistarPedidosEntregadosporId(){

        // $id_local = $_SESSION['id_local'];
        $id_venta = $_POST["id_venta"];
        $respuesta = pedidomotorizadocontroller::ctrListarPedidosEntregadosporId($id_venta);
        echo json_encode($respuesta);
        

    }

}

$resp = new listarPedidosEntregadosporId();
$resp->ajaxlistarPedidosEntregadosporId();