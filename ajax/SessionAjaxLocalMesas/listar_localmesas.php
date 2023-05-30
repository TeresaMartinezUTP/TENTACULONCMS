<?php
require_once '../../controller/localmesa_controller.php';
require_once '../../model/localmesa_model.php';
class listarLocalMesaajax
{
    public function ajaxlistarLocalMesa()
    {
        $tabla = "local_mesas";
            $response = localmesacontroller::ctrListarLocalMesa($tabla);
            for ($i = 0; $i < count($response); $i++) {
                $respuesta[$i]['local'] = '<p class="font-weight-bold text-black">' . $response[$i]['local'] . '</p>';
                $response[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarLocalMesa" onclick="btnEditarLocalmesa(' . $response[$i]["id_mesa"] . ');"><i class="fas fa-pencil-alt" style="margin-top: 1px !important;"></i>
            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarlocalmesa(' . $response[$i]["id_mesa"] . ');"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
            </td>';
            if ($response[$i]['estado'] == 'Activo') {
                $response[$i]['estado'] = '<span class="badge badge-success p-2">' . $response[$i]["estado"] . '</span>';
            }else if ($response[$i]['estado'] == 'Reservado') {
                $response[$i]['estado'] = '<span class="badge badge-warning p-2">' . $response[$i]["estado"] . '</span>';
            }else if ($response[$i]['estado'] == 'Ocupado') {
                $response[$i]['estado'] = '<span class="badge badge-dark p-2">' . $response[$i]["estado"] . '</span>';
            }else if ($response[$i]['estado'] == 'Inactivo') {
                $response[$i]['estado'] = '<span class="badge badge-danger p-2">' . $response[$i]["estado"] . '</span>';
            }
            }
        echo json_encode($response);
    }
}

$resp = new listarLocalMesaajax();
$resp->ajaxlistarLocalMesa();
