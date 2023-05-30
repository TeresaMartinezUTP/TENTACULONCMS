<?php
require_once '../../controller/venta_controller.php';
require_once '../../model/venta_model.php';
session_start();

class listarTempventaajax
{
    public function ajaxTempventaListar()
    {
        $id_local = $_SESSION['id_local'];
        $rol=$_SESSION['tipo_trabajador'];
        $tabla ="venta";
        $response = ControllerVenta::ctrListarVentas($tabla,$id_local,$rol);

        for ($i = 0; $i < count($response); $i++) {
        $response2 = ControllerVenta::ctrListarVentaParte($response[$i]['id_venta']);

            if(empty($response2)){
                $response[$i]['ticket'] = '
                    <td>
                    <a class="btn btn-danger m-1"  target="_black" href="views/modulos/ticket.php?ticket=' . $response[$i]['id_venta'] . '" > <i class="mdi mdi-file-pdf"></i></a>
                    </td>';
            } else{
                $response[$i]['ticket'] = '
                <td>
                <button class="btn btn-warning m-1" data-toggle="modal" data-target="#ticketporparte" onClick="mostrarticketporpartes(' . $response[$i]['id_venta'] . ')"> <i class="mdi mdi-file-pdf"></i></button>
                </td>';
            }
        
           
            if ($response[$i]['atencion'] == "Presencial") {
                $response[$i]['atencion'] = $response[$i]['nombre_mesa'];
            }
        }

        echo json_encode($response);
    }
}

$resp = new listarTempventaajax();
$resp->ajaxTempventaListar();
