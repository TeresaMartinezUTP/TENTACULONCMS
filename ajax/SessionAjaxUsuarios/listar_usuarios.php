<?php 
require_once "../../controller/usuarios_controller.php";
require_once '../../model/usuarios_model.php';
require_once '../../extensiones/encriptacion.php';
session_start();

class listarusuarios{
    public function ajaxListarUsuarios(){
        $tabla='usuarios';
        /* if($_SESSION['rol']=="Administrador General"){ */
            $response = usuarioscontroller::ctrListarUsuarios($tabla);
            for ($i=0; $i < count($response); $i++) {
                $encrypt = Encriptacion::encryption($response[$i]['id_usuario']);
                $encryptEmpl = Encriptacion::encryption($response[$i]['id_empleado']);
                if ($response[$i]['estado'] == "Activo") {
                    $response[$i]['local'] = '<td>' . $response[$i]['sede'] . ' || ' . $response[$i]['direccion'] . '</td>';
                    $response[$i]['estado'] = '<span class="badge badge-success p-2">' . $response[$i]['estado'] . '</span>';
                    $response[$i]['acciones'] = '
                            <td>
                            <button type="button" class="btn btn-primary btn-sm m-1"  data-toggle="modal" data-target="#mdlUdpUsuario" data-toggle="tooltip" data-placement="top" title="Actualizar usuario" onclick="btnEditarUsuario(' . "'".$encrypt."'" . ');"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#eliminarModal" data-toggle="tooltip" data-placement="top" title="Eliminar usuario" class="btn btn-danger btn-sm m-1" onclick="btnEliminarUsuario(' . "'".$encrypt."'" . ');"><i class="fas fa-trash-alt" style="margin-top: 1px !important;"></i></button>
                            <button type="button" class="btn btn-warning btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Inactivar usuario" onclick="btnInactivoEmpleado(' . "'" . $encryptEmpl . "'" . ');"><i class="fa fa-solid fa-ban"></i></button>
                            </td>';
                } else if ($response[$i]['estado'] == "Ausente") {
                    $response[$i]['local'] = '<td>' . $response[$i]['sede'] . ' || ' . $response[$i]['direccion'] . '</td>';
                    $response[$i]['estado'] = '<span class="badge badge-warning p-2">' . $response[$i]['estado'] . '</span>';
                    $response[$i]['acciones'] = '
                            <td>
                            <button type="button" class="btn btn-success btn-sm m-1" onclick="btnReingresarEmpleado(' . "'" . $encryptEmpl . "'" . ');"><i class="mdi mdi-door-open"></i></button>
                            </td>';
                } else {
                    if ($response[$i]['estado'] == "Inactivo") {
                        $response[$i]['local'] = '<td>' . $response[$i]['sede'] . ' || ' . $response[$i]['direccion'] . '</td>';
                        $response[$i]['estado'] = '<span class="badge badge-danger p-2">' . $response[$i]['estado'] . '</span>';
                        $response[$i]['acciones'] = '
                                <td>
                                <button type="button" class="btn btn-success btn-sm m-1" onclick="btnReingresarEmpleado(' . "'" . $encryptEmpl . "'" . ');"><i class="fa fa-solid fa-door-open"></i></button>
                                </td>';
                    }
                }
            }
       /*  }else if($_SESSION['rol']=="Administrador"){
            $response = usuarioscontroller::ctrListarUsuariosxSede($tabla, $_SESSION['nombre_sede']);
            for ($i = 0; $i < count($response); $i++) {
                $encrypt = Encriptacion::encryption($response[$i]['id_usuario']);
                if ($response[$i]['estado'] == "Activo") {
                    $response[$i]['local'] = '<td>' . $response[$i]['sede'] . ' || ' . $response[$i]['direccion'] . '</td>';
                    $response[$i]['estado'] = '<span class="badge badge-success p-2">' . $response[$i]['estado'] . '</span>';
                    $response[$i]['acciones'] = '
                            <td>
                            <button type="button" class="btn btn-primary m-1"  data-toggle="modal" data-target="#mdlActualizarUsuario" onclick="btnEditarUsu(' . "'".$encrypt."'" . ');"><i class="mdi mdi-pencil-outline"></i></button>
                            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarEmpleado(' . "'".$encrypt."'" . ');"><i class="mdi mdi-trash-can-outline"></i></button>
                            </td>';
                } else if ($response[$i]['estado'] == "Ausente") {
                    $response[$i]['local'] = '<td>' . $response[$i]['sede'] . ' || ' . $response[$i]['direccion'] . '</td>';
                    $response[$i]['estado'] = '<span class="badge badge-warning p-2">' . $response[$i]['estado'] . '</span>';
                    $response[$i]['acciones'] = '
                            <td>
                            <button type="button" class="btn btn-primary m-1"  data-toggle="modal" data-target="#mdlActualizarUsuario" onclick="btnEditarUsu(' . "'".$encrypt."'" . ');"><i class="mdi mdi-pencil-outline"></i></button>
                            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarEmpleado(' . "'".$encrypt."'" . ');"><i class="mdi mdi-trash-can-outline"></i></button>
                            </td>';
                } else if ($response[$i]['estado'] == "Inactivo") {
                    $response[$i]['local'] = '<td>' . $response[$i]['sede'] . ' || ' . $response[$i]['direccion'] . '</td>';
                    $response[$i]['estado'] = '<span class="badge badge-danger p-2">' . $response[$i]['estado'] . '</span>';
                    $response[$i]['acciones'] = '
                            <td>
                            <button type="button" class="btn btn-primary m-1"  data-toggle="modal" data-target="#mdlActualizarUsuario" onclick="btnEditarUsu(' . "'".$encrypt."'" . ');"><i class="mdi mdi-pencil-outline"></i></button>
                            <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarEmpleado(' . "'".$encrypt."'" . ');"><i class="mdi mdi-trash-can-outline"></i></button>
                            </td>';
                }
            }
        } */
        echo json_encode($response);
    }
}

$resp = new listarusuarios;
$resp->ajaxListarUsuarios();
?>