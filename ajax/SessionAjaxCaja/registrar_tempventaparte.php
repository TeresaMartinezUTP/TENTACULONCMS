<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class TempventaAjax
{
    public function ajaxTempventa()
    {
        if (isset($_POST["eliminar"])) {
            
            $response = ControllerCaja::ctrEliminarTempVentaParte($_POST["eliminar"]);

        } else {

            $id_usuario = $_SESSION['id_usuario'];
            $id_localplato = '';
            $id_localbebida = '';

            if ($_POST['id_localplato'] == null) {
                $id_localplato = NULL;
                $id_localbebida = $_POST['id_localbebida'];
            } else {
                $id_localbebida = NULL;
                $id_localplato = $_POST['id_localplato'];
            }

            $datos = array(
                "id_usuario" => $id_usuario,
                "id_localplato" => $id_localplato,
                "id_localbebida" => $id_localbebida,
                "precio_venta" => $_POST['precio_venta'],
            );

            $respuesta = ControllerCaja::ctrRegistrarTempVentaParte($datos);
            if ($respuesta == "error") {
                $response = array(
                    'response' => 'error'
                );
            } else {
                $response = $respuesta;
            }
        }
        echo json_encode($response);
    }
}

$resp = new TempventaAjax;
$resp->ajaxTempventa();
