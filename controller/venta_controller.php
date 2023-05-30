<?php
class ControllerVenta{
    static public function ctrListarVentas($tabla, $id_local,$rol){
        $respuesta = VentaModelo::mdlListarVentas($tabla, $id_local,$rol);
        return $respuesta;
    }

    static public function ctrListarVentas_DetalleVentas($id_local){
        $respuesta = VentaModelo::mdlListarVentas_DetalleVentas($id_local);
        return $respuesta;
    }

    static public function ctrListarEstadoDetalleVentaxIdVenta($id_venta){
        $respuesta = VentaModelo::mdlListarEstadoDetalleVentaxIdVenta($id_venta);
        return $respuesta;
    }

    static public function ctrActualizarMontopagado($monto_pagado, $id_venta){
        $respuesta = VentaModelo::mdlActualizarMontoPagado($monto_pagado, $id_venta);
        return $respuesta;
    }
    
    static public function ctrListarVentaParte($id_venta){
        $respuesta = VentaModelo::mdlListarVentaParte($id_venta);
        return $respuesta;
    }
}