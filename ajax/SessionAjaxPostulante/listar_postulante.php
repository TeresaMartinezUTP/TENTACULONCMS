<?php
require_once '../../controller/postulante_controller.php';
require_once '../../model/postulante_model.php';
require_once '../../extensiones/encriptacion.php';
class listarPostulanteajax
{
    public function ajaxlistarPostulante()
    {
        $tabla = "postulante";
        $response = postulantecontroller::ctrListarPostulante($tabla);
        for ($i = 0; $i < count($response); $i++) {
            $imagen = '\'' . $response[$i]["num_doc"] . '\'';
            /* $respuesta2 = postulantecontroller::ctrListarTablaPostulanteCV($response[$i]["num_doc"]); */
            $encry = Encriptacion::encryption($response[$i]["id_postulante"]);
            if ($response[$i]["estado"] == 'Activo') {
                $response[$i]["estado"] = ' <div class="btn-group">
                <button class="btn btn-info btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $response[$i]["estado"] . '</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button" onclick="btnAprobadoPostulante(' . "'" . $encry . "'" . ')">Aprobado</button>
                    <button class="dropdown-item" type="button" onclick="btnDesaprobadoPostulante(' . "'" . $encry . "'" . ')">Desaprobado</button>
                </div>
            </div>';
                $response[$i]['acciones'] = '
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mdlUdtPostulantes" onclick="btnEditarPostulante(' . "'" . $encry . "'" . ');">
                    <i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger" onclick="btnEliminarPostulante(' . "'" . $encry . "'" . ');">
                    <i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i>
                    </button>
            </td>';
            } else if ($response[$i]["estado"] == 'Aprobado' && $response[$i]["status"] != 1) {
                $response[$i]["estado"] = ' <span class="badge badge-success text-white p-2">Aprobado</span>';
                $response[$i]['acciones'] = '
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mdlUdtPostulantes" onclick="btnEditarPostulante(' . "'" . $encry . "'" . ');">
                    <i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="btnCambioEstado(' . "'" . $encry . "'" . ');">
                    <i class="fas fa-arrow-alt-circle-left"  style="margin-top: 2px !important;"></i>
                    </button>
                </td>';
            } else if ($response[$i]["estado"] == 'Desaprobado') {
                $response[$i]["estado"] = ' <span class="badge badge-danger p-2">Desaprobado</span>';
                $response[$i]['acciones'] = '
                <td>
                <button type="button" class="btn btn-warning btn-sm" onclick="btnCambioEstado(' . "'" . $encry . "'" . ');">
                <i class="fas fa-arrow-alt-circle-left"  style="margin-top: 2px !important;"></i>
                </button>
                <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger btn-sm" onclick="btnEliminarPostulante(' . "'" . $encry . "'" . ');">
                <i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i>
                </button>
                </td>';
            }else if ($response[$i]["estado"] == 'Aprobado' && $response[$i]["status"] == 1) {
                $response[$i]["estado"] = ' <span class="badge badge-informacion p-2">Trabajando</span>';
                $response[$i]['acciones'] = '
                <td>
                <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger btn-sm" onclick="btnEliminarPostulante(' . "'" . $encry . "'" . ');">
                <i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i>
                </button>
                </td>';
            }
            else{
                $response[$i]["estado"] = ' <span class="badge badge-danger p-2">Retirado</span>';
                $response[$i]['acciones'] = '
                <td>
                <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger btn-sm" onclick="btnEliminarPostulante(' . "'" . $encry . "'" . ');">
                <i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i>
                </button>
                </td>';
            }
            if ($response[$i]['telefono'] =="") {
                $response[$i]['telefono'] ="Sin registro";
            }
            if ($response[$i]['correo'] =="") {
                $response[$i]['correo'] ="Sin registro";
            }
            $response[$i]['documento'] = '
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary m-1 btn-sm" data-toggle="modal" data-target="#mdlCurriculumVitae" onclick="btnEnviaDatosCV(' . "'" . $encry . "'" . ');">
                    <i class="fa fa-solid fa-file-invoice"></i>&nbsp;&nbsp;CV
                    </button></div>
                </td>';
        }
        echo json_encode($response);
    }
}

$resp = new listarPostulanteajax();
$resp->ajaxlistarPostulante();
