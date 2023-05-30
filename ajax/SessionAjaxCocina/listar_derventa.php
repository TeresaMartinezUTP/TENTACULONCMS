<?php
require_once '../../controller/caja_controller.php';
require_once '../../model/caja_model.php';
session_start();

class listardetventaajax
{
    public function ajaxCocinalistardetventa()
    {

        $id_venta = $_POST['id_venta'];
        $response = ControllerCaja::ctrListarTabladetventa($id_venta);
        for ($i = 0; $i < count($response); $i++) {
            if ($response[$i]['id_localplato'] != null && $response[$i]['id_localbebida'] == null) {
                $response[$i]['nombre_producto'] = '<tr>' . $response[$i]['nombre_plato'] . '</tr>';
            } else  if ($response[$i]['id_localplato'] == null && $response[$i]['id_localbebida'] != null) {
                $response[$i]['nombre_producto'] = '<tr>' . $response[$i]['marca'] . ' ' . $response[$i]['descripcion'] . '</tr>';
            }
            if($response[$i]['cantidad']==1){
                $response[$i]['cantidades'] = '
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidad'] . ' min=1 disabled>
                <button type="button" class="btn btn-success m-0" onclick="btnSumarTotalVentaedit(' . ((int)$response[$i]['cantidad'] + 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-plus"></i></button>
                ';
            }else{
                $response[$i]['cantidades'] = '
                <button type="button" class="btn btn-danger m-0" onclick="btnRestarTotalVentaedit(' . ((int)$response[$i]['cantidad'] - 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-minus"></i></button>
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidad'] . ' min=1 disabled>
                <button type="button" class="btn btn-success m-0" onclick="btnSumarTotalVentaedit(' . ((int)$response[$i]['cantidad'] + 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-plus"></i></button>
                ';
            }
            
            $response[$i]['cantidadsoli'] = $response[$i]['cantidad'];
            if($response[$i]['cantidadcocinada'] ==0){
                $response[$i]['cantidadcoci'] = '
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidadcocinada'] . ' min=1 disabled>
                <button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpreparada(' . ((int)$response[$i]['cantidadcocinada'] + 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-plus"></i></button>
                ';
            }else if($response[$i]['cantidadcocinada'] ==$response[$i]['cantidad']){
                $response[$i]['cantidadcoci'] = '
                <button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpreparada(' . ((int)$response[$i]['cantidadcocinada'] - 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-minus"></i></button>
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidadcocinada'] . ' min=1 disabled>
                ';
            }else{
                $response[$i]['cantidadcoci'] = '
                <button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpreparada(' . ((int)$response[$i]['cantidadcocinada'] - 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-minus"></i></button>
                <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidadcocinada'] . ' min=1 disabled>
                <button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpreparada(' . ((int)$response[$i]['cantidadcocinada'] + 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-plus"></i></button>
                ';
            }
            
            $response[$i]['acciones'] = '
                    <td>
                    <button type="button" data-toggle="modal" data-target="#eliminarModal" class="btn btn-danger m-1" onclick="btnEliminarDetventa('.$response[$i]['id_detalle'].')"> <i class="mdi mdi-trash-can-outline"></i></button>
                    </td>';
            
            // PAGAR POR PARTES
            if($response[$i]['id_localplato'] == null){
                $response[$i]['id_localplato'] = "null";
            }
            if($response[$i]['id_localbebida'] == null){
                $response[$i]['id_localbebida'] = "null";
            }

            $cantrestante = $response[$i]['cantidadsoli'] - $response[$i]['cantidadpagada'];

            if($cantrestante >0){
                $response[$i]['cantidadpaga'] = '<div id="cantidadPagar' . $response[$i]['id_detalle'] .'">
            <button class="btn btn-success" onclick="registrarTempVentaPart('. $cantrestante . ',' . $response[$i]['id_detalle']. ',' . $response[$i]['id_localplato'] . ',' . $response[$i]['id_localbebida'] . ',' . $response[$i]['precio_venta'] .')">Pagar</button><input type="hidden" id="cancelarModal' . $response[$i]['id_detalle'] . '" /></div>';
            } else{
                $response[$i]['cantidadpaga'] = '<button class="btn btn-danger" disabled>Pagado</button><input type="hidden" id="cancelarModal' . $response[$i]['id_detalle'] . '" />';
            }
            
            // if($response[$i]['cantidadpagada'] ==0){
            //     $response[$i]['cantidadpaga'] = '
            //     <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidadpagada'] . ' min=1 disabled>
            //     <button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpagada(' . ((int)$response[$i]['cantidadpagada'] + 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-plus"></i></button>
            //     ';
            // }else if($response[$i]['cantidadpagada'] ==$response[$i]['cantidad']){
            //     $response[$i]['cantidadpaga'] = '
            //     <button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpagada(' . ((int)$response[$i]['cantidadpagada'] - 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-minus"></i></button>
            //     <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidadpagada'] . ' min=1 disabled>
            //     ';
            // }else{
            //     $response[$i]['cantidadpaga'] = '
            //     <button type="button" class="btn btn-danger m-0" onclick="btnRestarcantidadpagada(' . ((int)$response[$i]['cantidadpagada'] - 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-minus"></i></button>
            //     <input type="number" class="m-0" style="width: 40px;height: 32px" " value=' . $response[$i]['cantidadpagada'] . ' min=1 disabled>
            //     <button type="button" class="btn btn-success m-0" onclick="btnSumarcantidadpagada(' . ((int)$response[$i]['cantidadpagada'] + 1) . ',' . $response[$i]['id_detalle'] . ');"> <i class="mdi mdi-plus"></i></button>
            //     ';
            // }
            //
            
            $response[$i]['cantidadrest'] = '<p id="cantidadrest' . $response[$i]['id_detalle'] . '" class="m-0">' . $cantrestante . '</p>';

            $response[$i]['descripcion'] = '<input type="hidden" id="hddidvparte' . $response[$i]['id_detalle'] . '" />' . $response[$i]['nombre_producto'];
        
            $response[$i]['precio_venta'] = '<input type="hidden" id="hddprecio' . $response[$i]['id_detalle'] . '" value="'.$response[$i]['precio_venta'].'" />' . $response[$i]['precio_venta'];
        
        }
        echo json_encode($response);
    }
}
$resp = new listardetventaajax;
$resp->ajaxCocinalistardetventa();
