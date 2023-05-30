<?php
require_once "../../controller/localplatos_controller.php";
require_once '../../model/localplatos_model.php';

class platoslocalAjax{
    public function Ajaxplatoslocal(){
        if (isset($_POST['listarPlato'])) {
            if ($_POST['listarLocal'] != null && $_POST['listarLocal'] != null) {
                $tabla = "local_platos";
                $datos = array(
                    "id_plato" => $_POST['listarPlato'],
                    "id_local" => $_POST['listarLocal'],
                    
                );
                $respuesta = platolocalcontroller::ctrRegistrarPlatoLocal($tabla, $datos);
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
        }else if (isset($_POST["id_plalocal"])) {
            $tabla = "local_platos";
            $id_pl = $_POST["id_plalocal"];
            $response = platolocalcontroller::ctrMostrarPlatoLocal($tabla,$id_pl);
        }else if (isset($_POST["listarPlatoED"])) {
            if ($_POST['listarLocalED'] != null && $_POST['listarPlatoED'] != null) {
                $tabla = "local_platos";
                $datos = array(
                    "id_plato" => $_POST['listarPlatoED'],
                    "id_local" => $_POST['listarLocalED'],                    
                    "id_localplato" => $_POST['id_plEditar'],
                    "estado" => $_POST['estadoED']
                );
                $respuesta = platolocalcontroller::ctrActualizarPlatoLocal($tabla,$datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'actualizado'
                    );
                } else if ($respuesta == "repeat") {
                    $response = array(
                        'response' => 'repeat'
                    );
                } else {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        }else if (isset($_POST["id_Eliminar"])) {
            $id_localplato = $_POST["id_Eliminar"];
            $tabla = "local_platos";
            $respuesta = platolocalcontroller::ctrEliminarPlatoLocal($tabla,$id_localplato);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'eliminado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        }else {
            $response = array(
                'response' => 'error'
            );
        }
        echo json_encode($response);
    }
}
$resp = new platoslocalAjax();
$resp->Ajaxplatoslocal();
