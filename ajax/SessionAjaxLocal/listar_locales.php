<?php 
require_once '../../controller/local_controller.php';
require_once '../../model/local_model.php';
require_once '../../extensiones/encriptacion.php';
class listarlocales{
    public function ajaxListarlocales(){
        $tabla='local';
        $response = localcontroller::ctrListarLocales($tabla);
        for ($i = 0; $i < count($response); $i++) {
        $encrypt = Encriptacion::encryption($response[$i]['id_local']);
        if($response[$i]['status']=='Activo'){
            $response[$i]['status']='<span class="badge badge-success p-2">' . $response[$i]["status"] . '</span>';
            $response[$i]['acciones'] = '
            <td>
            <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlUdpLocal" onclick="btnEditarLocal(' . "'".$encrypt."'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
            </button>
            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarlocal(' . "'".$encrypt."'" . ');"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
            </td>';
        }else {
            if($response[$i]['status']=='Inactivo'){
                $response[$i]['status']='<span class="badge badge-danger p-2">' . $response[$i]["status"] . '</span>';
                $response[$i]['acciones'] = '
                <td>
                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlUdpLocal" onclick="btnEditarLocal(' . "'".$encrypt."'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
                </button>
                <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarlocal(' . "'".$encrypt."'" . ');"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
                </td>';
            }
        }
        
        }

        echo json_encode($response);
    }
}

$resp = new listarlocales();
$resp->ajaxListarlocales();
