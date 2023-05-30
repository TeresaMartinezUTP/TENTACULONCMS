<?php
require_once '../../controller/buscar_controller.php';
require_once '../../model/buscar_model.php';
session_start();

class ListarBuscarAjax
{
    public function AjaxListarBuscar()
    {
        $respuesta = ControllerBuscar::ctrListarPlato($_POST['nombre'],$_SESSION['id_local']);


        echo json_encode($respuesta);
    }
}
$resp = new ListarBuscarAjax();
$resp->AjaxListarBuscar();