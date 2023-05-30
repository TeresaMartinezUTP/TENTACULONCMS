<?php
require_once '../../controller/empleado_controller.php';
require_once '../../model/empleado_model.php';
session_start();

class listarMotorizado
{
    public function ajax_Motorizados()
    {
        $id_local = $_SESSION['id_local'];
        $response = empleadoscontroller::ctrListarMotorizadosActivos($id_local);

        echo json_encode($response);
    }
}

$resp = new listarMotorizado();
$resp->ajax_Motorizados();
