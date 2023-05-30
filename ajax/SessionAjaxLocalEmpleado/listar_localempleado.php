<?php
require_once '../../controller/localempleado_controller.php';
require_once '../../model/localempleado_model.php';
require_once '../../extensiones/encriptacion.php';

class listarlocalempleado
{
    public function ajaxListarLocalEmpleado()
    {
        $tabla = "local_empleado";
        $response = localempleadocontroller::ctrListarLocalEmpledo($tabla);
        for ($i = 0; $i < count($response); $i++) {
            $encrypt = Encriptacion::encryption($response[$i]['id_localemple']);
            $response[$i]['empleado'] = '<td>' . $response[$i]["nombres"] . '</td>';
            $response[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarLocalEmpleado" onclick="btnEditarLocalEmpleado(' . "'" . $encrypt . "'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
            </button>
            <button type="button" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarLocalEmpleado(' . "'" . $encrypt . "'" . ');"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i></button>
            </td>';
        }
        echo json_encode($response);
    }
}
$resp = new listarlocalempleado();
$resp->ajaxListarLocalEmpleado();
