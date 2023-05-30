<?php
require_once '../../controller/categoriaplatos_controller.php';
require_once '../../model/categoriaplatos_model.php';
require_once '../../extensiones/encriptacion.php';
class listarcategoriaplatos
{
    public function ajaxListarcategoriaplatos()
    {
        $tabla = 'categoria_platos';
        $response = categoriaplatoscontroller::ctrListarCategoriaPlato($tabla);
        for ($i = 0; $i < count($response); $i++) {
            $encrypt = Encriptacion::encryption($response[$i]['id_categoria']);
            if ($response[$i]['status'] == 'Activo') {
                $response[$i]['status'] = '<span class="badge badge-success p-2">' . $response[$i]["status"] . '</span>';
                if ($response[$i]['imagen'] == "") {
                    $response[$i]['imagen'] = "default.jpg";
                }
                $imagen =  '\'' . $response[$i]["imagen"] . '\'';
                $response[$i]['acciones'] = '
                <td>
                <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarCatePlato" onclick="btnEditarCategoriaPlato(' . "'" . $encrypt . "'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 1px !important;"></i>
                </button>
                <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarCategoriaPlato(' . "'" . $encrypt . "'" . ',' . $imagen . ')"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
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
                    <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlActualizarCatePlato" onclick="btnEditarCategoriaPlato(' . "'" . $encrypt . "'" . ');"><i class="fas fa-pencil-alt" style="margin-top:1px !important;"></i>
                    <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1 btn-sm" onclick="btnEliminarCategoriaPlato(' . "'" . $encrypt . "'" . ',' . $imagen . ')"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
                    </td>';
                }
            }
        }
        echo json_encode($response);
    }
}

$resp = new listarcategoriaplatos();
$resp->ajaxListarcategoriaplatos();
