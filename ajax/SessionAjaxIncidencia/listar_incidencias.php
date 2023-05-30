<?php
require_once '../../controller/incidencia_controller.php';
require_once '../../model/incidencia_model.php';

class ListarIncidenciasAjax
{
    public function AjaxListarIncidencias()
    {
        $respuesta = incidenciacontroller::ctrListarIncidencias();
        echo json_encode($respuesta);
    }
}

$resp = new ListarIncidenciasAjax();
$resp->AjaxListarIncidencias();