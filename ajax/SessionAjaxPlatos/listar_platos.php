<?php
require_once '../../controller/plato_controller.php';
require_once '../../model/plato_model.php';
require_once '../../extensiones/encriptacion.php';
class listarplatos{
    public function ajaxListarplatos(){
        $tabla='platos';
        $response = platoscontroller::ctrListarPlato($tabla);
        for ($i=0; $i < count($response); $i++) { 
            $encrypt = Encriptacion::encryption($response[$i]['id_plato']);
            if ($response[$i]['status'] == 'Activo') {
                $response[$i]['status'] = '<span class="badge badge-success p-2">' . $response[$i]["status"] . '</span>';
                if ($response[$i]['imagen'] == "") {
                    $response[$i]['imagen'] = "default.jpg";
                }
                $imagen =  '\'' . $response[$i]["imagen"] . '\'';
                $response[$i]['acciones'] = '
                <td>
                <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarPlatos" onclick="btnEditarPlatos(' . "'" . $encrypt . "'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
                </button>
                <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarPlatos(' . "'" . $encrypt . "'" . ',' . $imagen . ')"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i></button>
                </td>';
            } else {
                if($response[$i]['status']=='Inactivo'){
                    $response[$i]['status']='<span class="badge badge-danger p-2">' . $response[$i]["status"] . '</span>';
                    if ($response[$i]['imagen'] == "") {
                        $response[$i]['imagen'] = "default.jpg";
                    }
                    $imagen =  '\'' . $response[$i]["imagen"] . '\'';
                    $response[$i]['acciones'] = '
                    <td>
                    <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarPlatos" onclick="btnEditarPlatos(' . "'" . $encrypt . "'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarPlatos(' . "'" . $encrypt . "'" . ',' . $imagen . ')"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i></button>
                    </td>';
                }
            }
        }

        echo json_encode($response);
    }
}

$resp = new listarplatos();
$resp->ajaxListarplatos();
?>