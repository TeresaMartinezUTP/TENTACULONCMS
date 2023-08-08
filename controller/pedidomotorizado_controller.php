<?php
class pedidomotorizadocontroller{
    public static function ctrRegistrarPedidoMotorizado($datos)
    {
        $respuesta = pedido_motorizadomodel::mdlRegistrarPedidoMotorizado($datos);
        return $respuesta;
    }
    public static function ctrActualizarEstadoPedidoMotorizado($datos)
    {
        $respuesta = pedido_motorizadomodel::mdlActualizarEstadoPedidoMotorizado($datos);
        return $respuesta;
    }
    public static function ctrListaPedidoMotorizadoxVenta($id_venta)
    {
        $respuesta = pedido_motorizadomodel::mdlListaPedidoMotorizadoxVenta($id_venta);
        return $respuesta;
    }
    public static function ctrListarPedidosMotorizadoGeneral()
    {
        $respuesta = pedido_motorizadomodel::mdlListarPedidosMotorizadoGeneral();
        return $respuesta;
    }
    public static function ctrListarPedidosMotorizadoGeneralxSede($sede)
    {
        $respuesta = pedido_motorizadomodel::mdlListarPedidosMotorizadoGeneralxSede($sede);
        return $respuesta;
    }
    public static function ctrListarPedidoMotorizado($id_localemple)
    {
        $respuesta = pedido_motorizadomodel::mdlListarPedidosMotorizado($id_localemple);
        return $respuesta;
    }

    public static function ctrListarDetallePedidoMotorizado($id_venta)
    {
        $respuesta = pedido_motorizadomodel::mdlListarDetallePedidosMotorizado($id_venta);
        return $respuesta;
    }

    public static function ctrListarPedidoMotorizadoxId($id_p_motorizado)
    {
        $respuesta = pedido_motorizadomodel::mdlListaPedidoMotorizado($id_p_motorizado);
        return $respuesta;
    }

    public static function ctrActualizarPedidoMotorizado($id_p_motorizado, $datos)
    {
        $respuesta = pedido_motorizadomodel::mdlActualizarPedidoMotorizado($id_p_motorizado, $datos);
        return $respuesta;
    }

    public static function ctrFinalizarVenta($id_venta)
    {
        $respuesta = pedido_motorizadomodel::mdlFinalizarVenta($id_venta);
        return $respuesta;
    }

    public static function ctrListarPedidosEntregados($id_local,$rol,$id_empleado)
    {
        $respuesta = pedido_motorizadomodel::mdlListarPedidosEntregados($id_local,$rol,$id_empleado);
        return $respuesta;
    }

    public static function ctrListarPedidosEntregadosporId($id_venta)
    {
        $respuesta = pedido_motorizadomodel::mdlListarPedidosEntregadosporId($id_venta);
        return $respuesta;
    }
    
    public static function ctrListarPedidosEntregadosxSede($sede)
    {
        $respuesta = pedido_motorizadomodel::mdlListarPedidosEntregadosxSede($sede);
        return $respuesta;
    }
}
