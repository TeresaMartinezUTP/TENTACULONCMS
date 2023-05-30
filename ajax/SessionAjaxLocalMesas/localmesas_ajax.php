<?php
require_once '../../controller/localmesa_controller.php';
require_once '../../model/localmesa_model.php';

class localmesaAjax
{
    public function ajaxLocalmesa()
    {
        if (isset($_POST['nom_mesa'])) {
            if ($_POST['nom_mesa'] != null && $_POST['item_local'])
            $tabla="local_mesas";
                $datos = array(
                    "nombre_mesa" => $_POST['nom_mesa'],
                    "id_local" => $_POST['item_local'],
                );
            $respuesta = localmesacontroller::ctrRegistrarLocalMesa($tabla,$datos);
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
        } else if (isset($_POST["id_mesa"])) {
            $id_mesa = $_POST["id_mesa"];
            $tabla="local_mesas";
            $response = localmesacontroller::ctrMostrarLocalMesa($tabla,$id_mesa);
        } else if (isset($_POST['idLocalMesa'])) {
            if ($_POST['item_localEditar'] != null && $_POST['nom_mesaEditar'] != null && $_POST['estadoMesa'] != null) {
                $tabla="local_mesas";
                $datos = array(
                    "nombre_mesa" => $_POST['nom_mesaEditar'],
                    "id_local" => $_POST['item_localEditar'],
                    "id_mesa" => $_POST['idLocalMesa'],
                    "estado" => $_POST['estadoMesa']

                );
                $respuesta = localmesacontroller::ctrActualizarLocalMesa($tabla,$datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'actualizado'
                    );
                } 
                else if ($respuesta == "repeat") {
                    $response = array(
                        'response' => 'repeat'
                    );
                }else {
                    if ($respuesta == "error") {
                        $response = array(
                            'response' => 'error'
                        );
                    }
                }
            }
        } else if (isset($_POST["id_mesaElm"])) {
            $id_local = $_POST["id_mesaElm"];
            $tabla="local_mesas";
            $respuesta = localmesacontroller::ctrEliminarLocalMesa($tabla,$id_local);
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
        } else {
            $response = array(
                'response' => 'error'
            );
        }
        echo json_encode($response);
    }
}

$resp = new localmesaAjax;
$resp->ajaxLocalmesa();