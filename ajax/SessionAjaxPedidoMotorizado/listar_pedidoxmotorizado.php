<?php
require_once '../../controller/pedidomotorizado_controller.php';
require_once '../../model/pedidomotorizado_model.php';

session_start();
class listarpedidoxmotorizadoajax{

    public function ajaxlistarpedidoxmotorizado(){
        $id_local = $_SESSION['id_local'];
        $id_localemple = $_SESSION['id_localemple'];
        $rol = $_SESSION['tipo_trabajador'];
        if (isset($_POST['sede'])) {
            $sede = $_POST['sede'];
            $response = pedidomotorizadocontroller::ctrListarPedidosMotorizadoGeneralxSede($sede);
        }else if($rol=="Administrador General"){
            $response = pedidomotorizadocontroller::ctrListarPedidosMotorizadoGeneral();
        }else if($rol =="Administrador"||$rol =="Counte en caja"){
            $response = pedidomotorizadocontroller::ctrListarPedidosMotorizadoGeneralxSede($id_local);
        }
        else if ($rol=="Delivery motorizado"){
            $response = pedidomotorizadocontroller::ctrListarPedidoMotorizado($id_localemple);
        }
        echo json_encode($response);
    }

}

$resp = new listarpedidoxmotorizadoajax();
$resp->ajaxlistarpedidoxmotorizado();