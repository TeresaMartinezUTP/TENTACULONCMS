<?php
require_once '../../controller/cocina_controller.php';
require_once '../../model/cocina_model.php';
session_start();

class listarordenesCocinaajax
{
    public function ajaxCocinalistarordenes()
    {
        if(isset($_POST['presencial'])){
            $id_local = $_SESSION['id_local'];
            $tabla = "venta";
            $respuesta = cocinaControlador::ctrListarOrdenes($tabla, $id_local);
            for ($i = 0; $i < count($respuesta); $i++) {
                $respuesta[$i]['modificar'] = '
                        <td><div class="btn-group">
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlupcaja" onclick="btnverdetalleventa(' . $respuesta[$i]['id_venta'] . ',ListarCajaedit)"><i class="mdi mdi-pencil-outline"></i></button></div>
                        </td>';
                $respuesta[$i]['pendientes'] = '
                        <td><div class="btn-group">
                        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#mdlupcajapendiente" onclick="btnverdetalleventapendiente(' . $respuesta[$i]['id_venta'] . ')"><i class="mdi mdi-food"></i></button></div>
                        </td>';
                $respuesta[$i]['pagarxpartes'] = '
                        <td><div class="btn-group">
                        <button type="button" class="btn btn-warning m-1 btn-sm" data-toggle="modal" data-target="#mdlpagarxpartes" onclick="pagarXpartes(' . $respuesta[$i]['id_venta'] . ')"><i class="fa fa-solid fa-coins"></i></button></div>
                        </td>';
                $dv = cocinaControlador::ctrListarDetalleVenta($respuesta[$i]['id_venta']);
                $dvestado=0;
                for ($x = 0; $x < count($dv); $x++) {
                    if ($dv[$x]['estado']=="Preparado") {
                        $dvestado=$dvestado+1;
                    }
                }
                $btnfin=" ";
                    if ($dvestado!=count($dv)) {
                        $btnfin=" disabled style='cursor: not-allowed'";
                    }
                $respuesta[$i]['finalizar'] = '
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-success m-1 btn-sm" onclick="btnFinalizarVenta(' . $respuesta[$i]['id_venta'] . ')"'.$btnfin.'><i class="mdi mdi-share"></i></button></div>
                        </td>';
            }
        }else if(isset($_POST['delivery'])){
            $id_local = $_SESSION['id_local'];
            $tabla = "venta";
            $respuesta = cocinaControlador::ctrListarDelivery($tabla, $id_local);
            for ($i = 0; $i < count($respuesta); $i++) {
                $btnfin=" ";
                if ($respuesta[$i]['ruta_imagen'] =="" || $respuesta[$i]['ruta_imagen'] == null) {
                    $btnfin=" disabled style='cursor: not-allowed'";
                }

                $dv = cocinaControlador::ctrListarDetalleVenta($respuesta[$i]['id_venta']);
                $dvestado=0;
                for ($x = 0; $x < count($dv); $x++) {
                    if ($dv[$x]['estado']=="Preparado") {
                        $dvestado=$dvestado+1;
                    }
                }
                $btnfinP=" ";
                $enlace="";
                    if ($dvestado!=count($dv)) {
                        $btnfinP=" disabled style='cursor: not-allowed'";
                    }else{
                        $enlace='href="views/modulos/ticket.php?ticket=' . $respuesta[$i]['id_venta'] . '"';
                    }
                $respuesta[$i]['voucher'] = '
                    <td>
                    <div class="btn-group">
                        <a target="_black" '.$enlace.'>
                            <button class="btn btn-danger m-1"  '.$btnfinP.'>
                            <i class="mdi mdi-file-pdf"></i>
                            </button>
                        </a>
                    </div>
                    </td>';
                $respuesta[$i]['imagen'] = '
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success m-1 btn-sm" data-toggle="modal" data-target="#mdlVisualizarIPago" onclick="btnImagenPago(' . $respuesta[$i]['id_venta'] . ');"><i class="fa fa-solid fa-file-invoice-dollar"></i></button></div>
                        </td>';
                $respuesta[$i]['modificar'] = '
                        <td>
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlcajaDelivery" onclick="btnverdetalleventa(' . $respuesta[$i]['id_venta'] . ',ListarCajaDelivery)"><i class="mdi mdi-pencil-outline"></i></button>
                        </td>';
                $respuesta[$i]['pendientes'] = '
                        <td><div class="btn-group">
                        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#mdlupcajapendiente" onclick="btnverdetalleventapendiente(' . $respuesta[$i]['id_venta'] . ')"'.$btnfin.'><i class="mdi mdi-food"></i></button></div>
                        </td>';
            }
        }else if(isset($_POST['recojo'])){
            $id_local = $_SESSION['id_local'];
            $tabla = "venta";
            $respuesta = cocinaControlador::ctrListarRecojo($tabla, $id_local);
            $contR=0;
            $btnfinR="disabled style='cursor: not-allowed'";
            for ($i = 0; $i < count($respuesta); $i++) {
                $dvR = cocinaControlador::ctrListarDetalleVenta($respuesta[$i]['id_venta']);
                for ($z=0; $z < count($dvR); $z++) { 
                    if ($dvR[$z]['estado']=="Preparado") {
                        $contR=$contR+1;
                    }
                }
                if ($contR==count($dvR)) {
                    $btnfinR=" ";
                   
                }
                $respuesta[$i]['modificar'] = '
                        <td>
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#mdlcajaRecojo" onclick="btnverdetalleventa(' . $respuesta[$i]['id_venta'] . ',ListarCajaRecojo)"><i class="mdi mdi-pencil-outline"></i></button>
                        </td>';
                $respuesta[$i]['pendientes'] = '
                        <td><div class="btn-group">
                        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#mdlupcajapendiente" onclick="btnverdetalleventapendiente(' . $respuesta[$i]['id_venta'] . ')"><i class="mdi mdi-food"></i></button></div>
                        </td>';
                $respuesta[$i]['finalizar'] = '
                        <td>
                        <button type="button" class="btn btn-success m-1 btn-sm" onclick="btnFinalizarVenta(' . $respuesta[$i]['id_venta'] . ')" '.$btnfinR.'><i class="mdi mdi-share"></i></button>
                        </td>';
            }
        }else if(isset($_POST['todasVentas'])){
            $id_local = $_SESSION['id_local'];
            $rol=$_SESSION['tipo_trabajador'];
            $tabla = "venta";
            $respuesta = cocinaControlador::ctrListarTodasVentas($tabla, $id_local,$rol);
        } else if(isset($_POST['prioritario'])){
            $id_local = $_SESSION['id_local'];
            $tabla = "venta";
            $rol=$_SESSION['tipo_trabajador'];
            $respuesta = cocinaControlador::ctrListarVentasPrioritarias($tabla, $id_local,$rol);
        }

        echo json_encode($respuesta);
    }
}
$resp = new listarordenesCocinaajax;
$resp->ajaxCocinalistarordenes();
