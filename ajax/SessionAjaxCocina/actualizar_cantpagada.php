<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
class actualizarcantpagada{

    public function ajaxCocinalistardetventacp(){
        if(isset($_POST["preparartodo"])){
            $response = ControllerCaja::ctrActualizarcantpreparadaTodo($_POST["preparartodo"]);
        }else{
            $response = ControllerCaja::ctrActualizarcantpagada($_POST["cantidad"],$_POST["id_detalle"], $_POST['id_tempventaparte']);
        }
        echo json_encode($response);
    }
}
$resp = new actualizarcantpagada;
$resp->ajaxCocinalistardetventacp();