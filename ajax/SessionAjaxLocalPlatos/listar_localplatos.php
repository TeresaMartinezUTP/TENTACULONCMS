<?php
require_once '../../controller/localplatos_controller.php';
require_once '../../model/localplatos_model.php';
class listarLocalPlatosAjax
{
    public function ajaxlistarPlatoslocal()
    {
        $tabla = "local_platos";
        $response = platolocalcontroller::ctrListarPlatolocal($tabla);
        for ($i = 0; $i < count($response); $i++) {
            if ($response[$i]['estado'] == 'Activo') {
                $response[$i]['estado'] = '<span class="badge badge-success p-2">' . $response[$i]["estado"] . '</span>';
            } else {
                $response[$i]['estado'] = '<span class="badge badge-danger p-2">' . $response[$i]["estado"] . '</span>';
            }
            $response[$i]['sede'] = '<span class="font-weight-bold text-black">' . $response[$i]['sede'] . '</span>';
            $response[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarLocalPlato" onclick="btnEditarPlatoLocal(' . $response[$i]["id_localplato"] . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i></button>
            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarPlatoLocal(' . $response[$i]["id_localplato"] . ');"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i></button>
            </td>';
        }
        echo json_encode($response);
    }
}

$resp = new listarLocalPlatosAjax();
$resp->ajaxlistarPlatoslocal();
