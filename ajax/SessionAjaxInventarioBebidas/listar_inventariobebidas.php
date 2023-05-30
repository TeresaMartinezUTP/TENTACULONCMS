<?php
require_once '../../controller/inventariobebidas_controller.php';
require_once '../../model/inventariobebidas_model.php';

session_start();
class ListarBebidaLocalAjax
{
    public function AjaxListarBebidaLocal()
    {
        $tabla = "inventario_bebidas";
        $respuesta = inventariobebidascontroller::ctrListarInventarioBebidas($tabla);
        for ($i = 0; $i < count($respuesta); $i++) {
            if ($respuesta[$i]['estado'] == 'Activo') {
                $respuesta[$i]['estado'] = '<div class="btn-group">
                <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $respuesta[$i]["estado"] . '</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">                    
                    <button class="dropdown-item" type="button" onclick="btnInactivoLocalBebida(' . $respuesta[$i]['id_localbebida'] . ')">Inactivo</button>
                </div>
            </div>';
            $respuesta[$i]['acciones'] = '
                <td>
            <button type="button" class="btn btn-success m-1 btn-sm disabled" style="cursor: not-allowed"><i class="mdi mdi-bell"></i></button> 
        </td>';
            } else {
                $respuesta[$i]['estado']='<span class="badge badge-danger p-2">' . $respuesta[$i]["estado"] . '</span>';
                    $respuesta[$i]['acciones'] = '
                    <td>
                    <button type="button" class="btn btn-success m-1 btn-sm" onclick="btnReingresarBebidasLocal(' . $respuesta[$i]["id_localbebida"] . ');"><i class="mdi mdi-bell"></i></button>
                    </td>';
                }
            if ($respuesta[$i]['stock_total'] >= 90) {
                $respuesta[$i]['stockestado'] = '<span class="badge badge-success p-2">Stock lleno</span>';
            } else if ($respuesta[$i]['stock_total'] >= 10) {
                $respuesta[$i]['stockestado'] = '<span class="badge badge-warning p-2">Stock medio</span>';
            } else if ($respuesta[$i]['stock_total'] >= 5) {
                $respuesta[$i]['stockestado'] = '<span class="badge badge-danger p-2">Stock minimo</span>';
            } else {
                $respuesta[$i]['stockestado'] = '<span class="badge badge-dark p-2">Stock vacio</span>';
            }
        }
        echo json_encode($respuesta);
    }
}

$resp = new ListarBebidaLocalAjax();
$resp->AjaxListarBebidaLocal();
