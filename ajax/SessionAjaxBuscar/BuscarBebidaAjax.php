<?php
require_once '../../controller/buscar_controller.php';
require_once '../../model/buscar_model.php';
session_start();

class ListarBuscarBebidaAjax
{
    public function AjaxListarBuscarBebida()
    {
        $respuesta = ControllerBuscar::ctrListarBebida($_POST['descripcion'],$_SESSION['id_local']);
        echo json_encode($respuesta);
    }
}
$resp = new ListarBuscarBebidaAjax();
$resp->AjaxListarBuscarBebida();