<?php
require_once '../../controller/venta_controller.php';
require_once '../../model/venta_model.php';
session_start();

class listarVentaParteAjax
{
    public function ajaxListarVentaParte()
    {
        $id_venta =$_POST["id_venta"];
        $response = ControllerVenta::ctrListarVentaParte($id_venta);

        if(empty($response)){
           $respuesta = "vacio";
        } else{
            for ($i = 0; $i < count($response); $i++) {
            $response[$i]['ticket'] = '
                    <td>
                    <a class="btn btn-danger m-1"  target="_black" href="views/modulos/ticketporparte.php?ticket=' . $response[$i]['id_ventaparte'] . '" > <i class="mdi mdi-file-pdf"></i></a>
                    </td>';
        }

            $respuesta = $response;
    }
        

        // for ($i = 0; $i < count($response); $i++) {
        //     $response[$i]['ticket'] = '
        //             <td>
        //             <a class="btn btn-danger m-1"  target="_black" href="views/modulos/ticket.php?ticket=' . $response[$i]['id_venta'] . '" > <i class="mdi mdi-file-pdf"></i></a>
        //             </td>';
        // }

        echo json_encode($respuesta);
}
}
$resp = new listarVentaParteAjax();
$resp->ajaxListarVentaParte();