<?php
require_once '../../controller/bebida_controller.php';
require_once '../../model/bebida_model.php';
class ListarBebidaAjax
{
    public function AjaxListarBebida()
    {
        $tabla = "bebidas";
        $respuesta = bebidascontroller::ctrListarBebida($tabla);
        for ($i = 0; $i < count($respuesta); $i++) {
            if($respuesta[$i]['status']=='Activo'){
                $respuesta[$i]['status']='<span class="badge badge-success p-2">' . $respuesta[$i]["status"] . '</span>';
            }else{
                $respuesta[$i]['status']='<span class="badge badge-danger p-2">' . $respuesta[$i]["status"] . '</span>';
            }
            if ($respuesta[$i]['ruta_imagen'] == "") {
                $respuesta[$i]['ruta_imagen'] = "default.jpg";
            }
            $imagen =  '\'' . $respuesta[$i]["ruta_imagen"] . '\'';
            $respuesta[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarBebida" onclick="btnEditarBebida(' . $respuesta[$i]["id_bebida"] . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
            </button>
            <button type="button" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarBebida(' . $respuesta[$i]["id_bebida"] . ',' . $imagen . ')"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i></button>
            </td>';
        }
        echo json_encode($respuesta);
    }
}

$resp = new ListarBebidaAjax();
$resp->AjaxListarBebida();
