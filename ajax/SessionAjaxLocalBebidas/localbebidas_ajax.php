<?php
require_once '../../controller/localbebidas_controller.php';
require_once '../../model/localbebidas_model.php';

class localbebidasAjax
{
    public function ajaxLocalbebidas()
    {
        if (isset($_POST['listarBebida'])) {
            if ($_POST['listarBebida'] != null && $_POST['listarLocal'] != null) {
                $tabla = "local_bebidas";
                $datos = array(
                    "id_bebida" => $_POST['listarBebida'],
                    "id_local" => $_POST['listarLocal']
                );
                $respuesta = localbebidascontroller::ctrRegistroLocalbebida($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'guardado'
                    );
                } else if ($respuesta == "repeat") {
                    $response = array(
                        'response' => 'repeat'
                    );
                } else {
                    if ($respuesta == "error") {
                        $response = array(
                            'response' => 'error'
                        );
                    }
                }
            }
        } else if (isset($_POST['id_localbebida'])) {
            $tabla = "local_bebidas";
            $response = localbebidascontroller::ctrMostrarLocalbebida($tabla, $_POST['id_localbebida']);
        } else if (isset($_POST['idLocalbebida'])) {
            if ($_POST['listarBebidaED'] != null && $_POST['listarLocalED'] != null) {
                $tabla = "local_bebidas";
                $datos = array(
                    "id_bebida" => $_POST['listarBebidaED'],
                    "id_local" => $_POST['listarLocalED'],
                    "estado" => $_POST['estadoED'],
                    "id_localbebida" => $_POST['idLocalbebida']
                );
                $respuesta = localbebidascontroller::ctrActualizarLocalBebida($tabla, $datos);
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
            }
        } else if (isset($_POST["id_localbebidaElm"])) {
            $id_local = $_POST["id_localbebidaElm"];
            $tabla = "local_bebidas";
            $respuesta = localbebidascontroller::ctrEliminarLocalBebida($tabla, $id_local);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
            }else if ($respuesta == 'usado') {
                $response = array(
                    'responseJson' => 'usado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        }else if(isset($_POST["listarBebidaselect"])){
            $sede =$_POST["listarBebidaselect"];
            $tabla="local_bebidas";
            $response = localbebidascontroller::ctrListarBebidasLocalSelect($tabla, $sede);
        } else if (isset($_POST["id_inactivo"])) {
            $id_localbebida = $_POST["id_inactivo"];
            $tabla = "local_bebidas";
            $estado = "Inactivo";
            $respuesta = localbebidascontroller::ctrCambiarEstado($tabla, $estado, $id_localbebida);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'true'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        } else if (isset($_POST["id_reingresar"])) {
            $id_localbebida = $_POST["id_reingresar"];
            $tabla = "local_bebidas";
            $estado = "Activo";
            $respuesta = localbebidascontroller::ctrCambiarEstado($tabla, $estado, $id_localbebida);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'true'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        }
        echo json_encode($response);
    }
}
$resp = new localbebidasAjax;
$resp->ajaxLocalbebidas();
