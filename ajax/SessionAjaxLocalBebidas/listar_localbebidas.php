<?php
require_once '../../controller/localbebidas_controller.php';
require_once '../../model/localbebidas_model.php';

class listarlocalbebidas
{
    public function ajaxListarlocalbebidas()
    {
        $tabla = "local_bebidas";
        $respuesta = localbebidascontroller::ctrListarLocalBebidas($tabla);
        for ($i = 0; $i < count($respuesta); $i++) {
            if ($respuesta[$i]['estado'] == 'Activo') {
                $respuesta[$i]['estado'] = '<span class="badge badge-success p-2">' . $respuesta[$i]["estado"] . '</span>';
            } else {
                $respuesta[$i]['estado'] = '<span class="badge badge-danger p-2">' . $respuesta[$i]["estado"] . '</span>';
            }
            $respuesta[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarLocalBebida" onclick="btnEditarLocalBebida(' . $respuesta[$i]["id_localbebida"] . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i></button>
            <button type="button" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarLocalBebida(' . $respuesta[$i]["id_localbebida"] . ');"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i></button>
            </td>';
        }
        echo json_encode($respuesta);
    }
}
$resp = new listarlocalbebidas();
$resp->ajaxListarlocalbebidas();
