<?php

require_once "../../controller/localempleado_controller.php";
require_once '../../model/localempleado_model.php';
require_once '../../extensiones/encriptacion.php';

class localempleadoajax
{
    public function ajaxlocalempleado()
    {
        if (isset($_POST['listarEmpleado'])) {
            if ($_POST['listarLocal'] != null && $_POST['listarEmpleado'] != null) {
                $tabla = "local_empleado";
                $datos = array(
                    "id_empleado" => $_POST['listarEmpleado'],
                    "id_local" => $_POST['listarLocal'],
                );
                $respuesta = localempleadocontroller::ctrRegistrarLocalEmpleado($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'guardado'
                    );
                }else if ($respuesta == "repeat") {
                    $response = array(
                        'responseJson' => 'repeat'
                    );
                }  else {
                    if ($respuesta == "error") {
                        $response = array(
                            'responseJson' => 'error'
                        );
                    }
                }
            }
        } else if (isset($_POST["id_localempleadoA"])) {
            $descryt = Encriptacion::decryption($_POST['id_localempleadoA']);
            $tabla = "local_empleado";
            $response = localempleadocontroller::ctrMostrarLocalEmpleado($tabla, $descryt);
        } else if (isset($_POST['id_localempleadoED'])){
            $tabla = "local_empleado";
            $datos = array(
                "id_localemple" => $_POST['id_localempleadoED'],
                "id_empleado" => $_POST['id_empleadoED'],
                "id_local" => $_POST['id_localED']
            );
            $respuesta = localempleadocontroller::ctrActualizarLocalEmpleado($tabla, $datos);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'actualizado'
                );
            } else if ($respuesta == "repeat") {
                $response = array(
                    'responseJson' => 'repeat'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        } else if (isset($_POST["id_localempleadoElm"])) {
            $descryt = Encriptacion::decryption($_POST['id_localempleadoElm']);
            $tabla = "local_empleado";
            $respuesta = localempleadocontroller::ctrEliminarLocalEmpleado($tabla, $descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }else if ($respuesta == "tieneus") {
                    $response = array(
                        'responseJson' => 'tieneus'
                    );
                }
            }
        }
        else {
            $response = array(
                'responseJson' => 'error'
            );
        }
        echo json_encode($response);
    }
}
$resp = new localempleadoajax();
$resp->ajaxlocalempleado();