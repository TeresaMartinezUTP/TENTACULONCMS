<?php
require_once '../../controller/pedidomotorizado_controller.php';
require_once '../../model/pedidomotorizado_model.php';

session_start();
class listarPedidosEntregados{

    public function ajaxlistarPedidosEntregados(){
        $id_local = $_SESSION['id_local'];
        $rol = $_SESSION['tipo_trabajador'];
        $id_empleado = $_SESSION['id_empleado'];
        if (isset($_POST['sede'])) {
            $sede = $_POST['sede'];
            $respuesta = pedidomotorizadocontroller::ctrListarPedidosEntregadosxSede($sede);
            for ($i = 0; $i < count($respuesta); $i++) {
                if ($respuesta[$i]['id_cliente_frecuente'] == 0) {
                    $respuesta[$i]['cliente'] = $respuesta[$i]['nombre_contacto'];
                }
                else{
                    $respuesta[$i]['cliente'] =$respuesta[$i]['nombre_completo'];
                }
                if ($respuesta[$i]['pm_estado']== "Entregado" ){
                    $respuesta[$i]['pm_estado']='<span class="badge badge-success p-2">' . $respuesta[$i]["pm_estado"] . '</span>';
                }else if($respuesta[$i]['pm_estado']=="En proceso"){
                    $respuesta[$i]['pm_estado']='<span class="badge badge-warning p-2">' . $respuesta[$i]["pm_estado"] . '</span>';
                }else{
                    $respuesta[$i]['pm_estado']='<span class="badge badge-danger p-2">' . $respuesta[$i]["pm_estado"] . '</span>';
                }
                $respuesta[$i]['detalle'] = '
                <td>
                <button type="button" class="btn btn-info m-1 btn-sm" data-toggle="modal" data-target="#mdlpedidosentregados" onclick="MostrarDetalleVenta(' . $respuesta[$i]["id_venta"] . ')"><i class="fa fa-solid fa-eye" style="margin-top: 2px !important;"></i>
                </button>
                </td>';
            }
        }else{
            $respuesta = pedidomotorizadocontroller::ctrListarPedidosEntregados($id_local,$rol,$id_empleado);
            for ($i = 0; $i < count($respuesta); $i++) {
                if ($respuesta[$i]['id_cliente_frecuente'] == 0) {
                    $respuesta[$i]['cliente'] = $respuesta[$i]['nombre_contacto'];
                }
                else{
                    $respuesta[$i]['cliente'] =$respuesta[$i]['nombre_completo'];
                }
                if ($respuesta[$i]['pm_estado']== "Entregado" ){
                    $respuesta[$i]['pm_estado']='<span class="badge badge-success p-2">' . $respuesta[$i]["pm_estado"] . '</span>';
                }else if($respuesta[$i]['pm_estado']=="En proceso"){
                    $respuesta[$i]['pm_estado']='<span class="badge badge-warning p-2">' . $respuesta[$i]["pm_estado"] . '</span>';
                }else{
                    $respuesta[$i]['pm_estado']='<span class="badge badge-danger p-2">' . $respuesta[$i]["pm_estado"] . '</span>';
                }
                $respuesta[$i]['detalle'] = '
                <td>
                <button type="button" class="btn btn-info m-1 btn-sm" data-toggle="modal" data-target="#mdlpedidosentregados" onclick="MostrarDetalleVenta(' . $respuesta[$i]["id_venta"] . ')"><i class="fa fa-solid fa-eye" style="margin-top: 2px !important;"></i>
                </button>
                </td>';
            }
        }

        echo json_encode($respuesta);
    }
}

$resp = new listarPedidosEntregados();
$resp->ajaxlistarPedidosEntregados();