<?php
class ControllerCaja{
    static public function ctrRegistrarVenta($datos, $id_usuario){
        $respuesta = CajaModelo::mdlRegistrarVenta($datos, $id_usuario);
        return $respuesta;
    }

    static public function ctrListarTablaTempventa($id_usuario){

        $respuesta = CajaModelo::mdlListarTablaTempventa($id_usuario);
        return $respuesta;
    }

    static public function ctrRegistrarTempventa($datos){
        $respuesta = CajaModelo::mdlRegistrarTempventa($datos);
        return $respuesta;
    }
    static public function ctrRegistrarUpventa($datos){
        $respuesta = CajaModelo::mdlRegistrarUpventa($datos);
        return $respuesta;
    }

    static public function ctrEliminarTempVenta($id_temp){
        $respuesta = CajaModelo::mdlEliminarTempVenta($id_temp);
        return $respuesta;
    }
    static public function ctrEliminardetVenta($id_detalle){
        $respuesta = CajaModelo::mdlEliminardetVenta($id_detalle);
        return $respuesta;
    }

    static public function ctrRegistrarTempventaBebida($datos){
        $respuesta = CajaModelo::mdlRegistrarTempventaBebida($datos);
        return $respuesta;
    }
    static public function ctrRegistrarupventaBebida($datos){
        $respuesta = CajaModelo::mdlRegistrarupventaBebida($datos);
        return $respuesta;
    }
    static public function ctrLimpiarTempVenta($id_usuario){
        $respuesta = CajaModelo::mdlLimpiarTempVenta($id_usuario);
        return $respuesta;
    }
    static public function ctrActualizarTotalTempVenta($cantidad,$id_temp){
        $respuesta = CajaModelo::mdlActualizarTotalTempVenta($cantidad,$id_temp);
        return $respuesta;
    }
    static public function ctrActualizarclifrefromventa($id_venta,$id_clifre){
        $respuesta = CajaModelo::mdlActualizarclifrefromventa($id_venta,$id_clifre);
        return $respuesta;
    }
    static public function ctrActualizarTotaldetVenta($cantidad,$id_detalle){
        $respuesta = CajaModelo::mdlActualizarTotaldetVenta($cantidad,$id_detalle);
        return $respuesta;
    }
    static public function ctrMostrardatosventa($id_usuario){

        $respuesta = CajaModelo::mdlMostrardatosventa($id_usuario);
        return $respuesta;
    }
    static public function ctrMostrarVenta($id_venta){

        $respuesta = CajaModelo::mdlMostrarVenta($id_venta);
        return $respuesta;
    }
    static public function ctrActualizarVenta($datos){

        $respuesta = CajaModelo::mdlActualizarVenta($datos);
        return $respuesta;
    }
    static public function ctrListarTabladetventa($id_venta){

        $respuesta = CajaModelo::mdlListarTabladetventa($id_venta);
        return $respuesta;
    }
    static public function ctrMostrardatosventa2($id_venta){

        $respuesta = CajaModelo::mdlMostrardatosventa2($id_venta);
        return $respuesta;
    }
    static public function ctrActualizarcantpreparada($cantidad,$id_detalle){

        $respuesta = CajaModelo::mdlActualizarcantpreparada($cantidad,$id_detalle);
        return $respuesta;
    }
    static public function ctrActualizarestadoventa($id_venta){

        $respuesta = CajaModelo::mdlActualizarestadoventa($id_venta);
        return $respuesta;
    }
    static public function ctrActualizaPrioridadventa($datos){

        $respuesta = CajaModelo::mdlActualizaPrioridadventa($datos);
        return $respuesta;
    }
    
    static public function ctrActualizarcantpagada($cantidad,$id_detalle, $id_tempventaparte){
        $respuesta = CajaModelo::mdlActualizarcantpagada($cantidad,$id_detalle, $id_tempventaparte);
        return $respuesta;
    }

    static public function ctrRegistrarTempVentaParte($datos){
        $respuesta = CajaModelo::mdlRegistrarTempVentaParte($datos);
        return $respuesta;
    }

    static public function ctrActualizarcantpreparadaTodo($id_venta){
        $respuesta = CajaModelo::mdlActualizarcantpreparadaTodo($id_venta);
        return $respuesta;
    }
    
    static public function ctrEliminarTempVentaParte($id_tempventaparte){
        $respuesta = CajaModelo::mdlEliminarTempVentaParte($id_tempventaparte);
        return $respuesta;
    }

    static public function ctrRegistrarPagoParte($datos, $id_usuario){
        $respuesta = CajaModelo::mdlRegistrarVentaParte($datos, $id_usuario);
        return $respuesta;
    }
}