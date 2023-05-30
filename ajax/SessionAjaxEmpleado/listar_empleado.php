<?php
require_once '../../controller/empleado_controller.php';
require_once '../../model/empleado_model.php';
require_once '../../extensiones/encriptacion.php';
class listarEmpleadoajax
{
    public function ajaxlistarEmpleado()
    {
        $tabla = "empleado";
        $response = empleadoscontroller::ctrListarEmpleados($tabla);
        for ($i = 0; $i < count($response); $i++) {
            $encry = Encriptacion::encryption($response[$i]["id_empleado"]);
            if ($response[$i]["telefono"] == "") {
                $response[$i]["telefono"] = "Sin registro";
            }
            if ($response[$i]["estado"] == 'Activo') {
                $response[$i]["estado"] = '  <div class="btn-group">
                    <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $response[$i]["estado"] . '</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button" onclick="btnAusenteEmpleado(' . "'" . $encry . "'" . ')">Ausente</button>
                        <button class="dropdown-item" type="button" onclick="btnInactivoEmpleado(' . "'" . $encry . "'" . ')">Inactivo</button>
                    </div>
                </div>';
                $response[$i]['acciones'] = '
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mdlUdtEmpleados" onclick="btnEditarEmpleado(' . "'" . $encry . "'" . ');"><i class="fas fa-pencil-alt" style="margin-top: 2px !important;"></i>
                        </button>
                        
                        <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger btn-sm -1" onclick="btnEliminarEmpleado(' . "'" . $encry . "'" . ');"><i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i>
                        </button>
                    </td>';
            } else if ($response[$i]["estado"] == 'Ausente') {
                $response[$i]["estado"] = ' <span class="badge badge-warning text-white p-2">Ausente</span>';
                $response[$i]['acciones'] = '
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="btnReingresarEmpleado(' . "'" . $encry . "'" . ');">
                            <i class="fas fa-arrow-alt-circle-left"  style="margin-top: 2px !important;"></i>
                            </button>
                            
                            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger btn-sm -1" onclick="btnEliminarEmpleado(' . "'" . $encry . "'" . ');">
                            <i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i>
                            </button>
                        </td>';
            } else if ($response[$i]["estado"] == 'Inactivo') {
                $response[$i]["estado"] = ' <span class="badge badge-danger p-2">Inactivo</span>';
                $response[$i]['acciones'] = '
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="btnReingresarEmpleado(' . "'" . $encry . "'" . ');">
                            <i class="fas fa-arrow-alt-circle-left"  style="margin-top: 2px !important;"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger btn-sm -1" onclick="btnEliminarEmpleado(' . "'" . $encry . "'" . ');">
                            <i class="fas fa-trash-alt" style="margin-top: 2px !important;"></i>
                            </button>
                        </td>';
            }

            $response[$i]['documentos'] = '
            <td>
            <div class="btn-group">
                <button type="button" class="btn btn-success m-1 btn-sm" data-toggle="modal" data-target="#mdlVisualizarCSalud" onclick="btnCarnetSanidad(' . "'" . $encry . "'" . ');"><i class="fas fa-file-medical"style="margin-top: 1px !important;"></i> CS</button></div>
            </td>';
        }
        echo json_encode($response);
    }
}

$resp = new listarEmpleadoajax();
$resp->ajaxlistarEmpleado();
