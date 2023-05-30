<?php

require_once 'conexion.php';
class VentaModelo
{
    static public function mdlListarVentas($tabla,$id_local,$rol)
    {
        $q="";
        if ($rol!="Administrador General") {
            $q="AND v.id_local='$id_local'";
        }
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla v LEFT JOIN local_mesas lm ON v.id_mesa = lm.id_mesa WHERE v.estado ='Finalizado' $q ORDER BY fecha_hora desc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarVentas_DetalleVentas($id_local){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM venta WHERE id_local='$id_local' AND atencion ='Delivery' AND estado ='Pendiente' ORDER BY fecha_hora desc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarEstadoDetalleVentaxIdVenta($id_venta){
        $stmt = Conexion::conectar()->prepare("SELECT pm.estado, pm.id_localemple from pedido_motorizado pm INNER JOIN venta v ON v.id_venta = pm.id_venta RIGHT JOIN local_empleado le ON pm.id_localemple = le.id_localemple WHERE v.id_venta = $id_venta");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlActualizarMontoPagado($monto_pagado, $id_venta)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE venta SET monto_pagado=$monto_pagado WHERE id_venta = '$id_venta'");
        $stmt->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    
    static public function mdlListarVentaParte($id_venta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM venta_parte WHERE id_venta = '$id_venta'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
}