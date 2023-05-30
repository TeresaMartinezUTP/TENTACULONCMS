<?php
require_once '../../controller/clientefre_controller.php';
require_once '../../model/clientefre_model.php';
session_start();
class listarClienteFrecuenteAjax
{
    public function ajaxClienteFrecuenteListar()
    {
        $tabla = "clientes_frecuentes";
        if($_SESSION['tipo_trabajador']=="Administrador General"){
        $response = clientefreControlador::ctrListarTablaClienFrecuente($tabla);
        for ($i = 0; $i < count($response); $i++) {
            if ($response[$i]['descuento'] == "0") {
                $response[$i]['descuento'] = 'Sin descuento';
            }
            if ($response[$i]['estado'] == "Activo") {
                $response[$i]['estado'] = '<span class="badge badge-success p-2">Activo</span>';
            } else if ($response[$i]['estado'] == "Inactivo") {
                $response[$i]['estado'] = '<span class="badge badge-danger p-2">Inactivo</span>';
            }
            $response[$i]['acciones'] = '
                    <td>
                    <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlClientesfreUp" onclick="btnEditarClientefre('.$response[$i]['id_cliente_frecuente'].')"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i></button>
                    <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarClientefre('.$response[$i]['id_cliente_frecuente'].')"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
                    </td>';
        }
        }else{
            if($_SESSION['tipo_trabajador']=="Administrador"){
                $response = clientefreControlador::ctrListarTablaClienFrecuentexSede($tabla,$_SESSION['id_local']);
                for ($i = 0; $i < count($response); $i++) {
                    if($response[$i]['descuento'] =="0"){
                        $response[$i]['descuento'] = 'Sin descuento';
                    }
                    $response[$i]['acciones'] = '
                        <td>
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlClientesfreUp" onclick="btnEditarClientefre('.$response[$i]['id_cliente_frecuente'].')"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i></button>
                        <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarClientefre('.$response[$i]['id_cliente_frecuente'].')"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
                        </td>';
                }
            }
        }
        echo json_encode($response);
    }
}

$resp = new listarClienteFrecuenteAjax();
$resp->ajaxClienteFrecuenteListar();
