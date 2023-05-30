<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class Mostrardatosventa2ajax
{
    public function ajaxMostrardatosventa2()
    {
        $id_venta = $_POST['id_venta'];
        $response = ControllerCaja::ctrMostrardatosventa2($id_venta);
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

$resp = new Mostrardatosventa2ajax();
$resp->ajaxMostrardatosventa2();
