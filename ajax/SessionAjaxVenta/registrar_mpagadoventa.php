<?php
require_once '../../controller/venta_controller.php';
require_once '../../model/venta_model.php';

class registrar_montopagadoajax{
    public function ajaxRegistrarmontopagado(){
        $id_venta = $_POST["id_venta"];
        $monto_pagado = $_POST["monto_pagado"];
        ControllerVenta::ctrActualizarMontopagado($monto_pagado, $id_venta);
    }
}

$resp = new registrar_montopagadoajax();
$resp->ajaxRegistrarmontopagado();