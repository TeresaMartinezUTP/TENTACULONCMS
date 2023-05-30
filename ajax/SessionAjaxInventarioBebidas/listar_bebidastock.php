<?php
require_once '../../controller/inventariobebidas_controller.php';
require_once '../../model/inventariobebidas_model.php';

session_start();
class ListarBebidaStockLocalAjax
{
    public function AjaxListarBebidaStock()
    {
        $tabla = "inventario_bebidas";
        $respuesta = inventariobebidascontroller::ctrListarBebidaStock($tabla);
        for ($i = 0; $i < count($respuesta); $i++) {
            $respuesta[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlActualizarBebidaInventario" onclick="btnEditarBebidaInventario(' . $respuesta[$i]["id_inventario"] . ');"><i class="mdi mdi-pencil-outline"></i></button>
            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarBebidaInventario(' . $respuesta[$i]["id_inventario"] . ');"><i class="mdi mdi-trash-can-outline"></i></button>
        </td>';
        }
        echo json_encode($respuesta);
    }
}

$resp = new ListarBebidaStockLocalAjax();
$resp->AjaxListarBebidaStock();
