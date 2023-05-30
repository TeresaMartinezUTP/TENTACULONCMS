<?php
class cocinaControlador{
    static public function ctrListarOrdenes($tabla, $id_local){
        $respuesta = cocinamodelo::mdlListarOrdenes($tabla, $id_local);
        return $respuesta;
    }

    static public function ctrListarDetOrdenes($tabla, $id_mesa){
        $respuesta = cocinamodelo::mdlListarDetOrdenes($tabla, $id_mesa);
        return $respuesta;
    }

    static public function ctrListarDetOrdenesxIdVenta($tabla, $id_venta){
        $respuesta = cocinamodelo::mdlListarDetOrdenesxIdVenta($tabla, $id_venta);
        return $respuesta;
    }
    static public function ctrListarDelivery($tabla,$id_local){
        $respuesta = cocinamodelo::mdlListarDelivery($tabla, $id_local);
        return $respuesta;
    }

    static public function ctrListarRecojo($tabla,$id_local){
        $respuesta = cocinamodelo::mdlListarRecojo($tabla, $id_local);
        return $respuesta;
    }

    static public function ctrListarTodasVentas($tabla,$id_local,$rol){
        $respuesta = cocinamodelo::mdlListarTodasVentas($tabla, $id_local,$rol);
        return $respuesta;
    }
    
    static public function ctrListarVentasPrioritarias($tabla,$id_local,$rol){
        $respuesta = cocinamodelo::mdlListarVentasPrioritarias($tabla, $id_local,$rol);
        return $respuesta;
    }
    
    static public function ctrListarDetalleVenta($id_venta){
        $respuesta = cocinamodelo::mdlListarDetalleVenta($id_venta);
        return $respuesta;
    }
}
