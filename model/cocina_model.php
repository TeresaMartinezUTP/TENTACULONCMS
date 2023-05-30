<?php
require_once 'conexion.php';
class cocinamodelo
{
    static public function mdlListarOrdenes($tabla, $id_local)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla v INNER JOIN local_mesas lm ON v.id_mesa = lm.id_mesa WHERE lm.id_local='$id_local' AND v.estado !='Finalizado' AND v.atencion='Presencial' ORDER BY fecha_hora asc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarDetOrdenes($tabla, $id_mesa)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.nombre_plato,b.descripcion,dv.cantidad,dv.cantidadcocinada ,dv.estado FROM $tabla dv INNER JOIN venta v ON dv.id_venta=v.id_venta LEFT JOIN platos p ON p.id_plato = dv.id_localplato LEFT JOIN bebidas b ON b.id_bebida= dv.id_localbebida WHERE v.id_mesa='$id_mesa' AND v.estado !='Finalizado'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarDetOrdenesxIdVenta($tabla, $id_venta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.nombre_plato,b.descripcion,dv.cantidad,dv.cantidadcocinada ,dv.estado FROM $tabla dv INNER JOIN venta v ON dv.id_venta=v.id_venta LEFT JOIN platos p ON p.id_plato = dv.id_localplato LEFT JOIN bebidas b ON b.id_bebida= dv.id_localbebida WHERE v.id_venta=$id_venta AND v.estado !='Finalizado'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarDelivery($tabla,$id_local){
        $stmt = Conexion::conectar()->prepare("SELECT v.*, lm.*, pm.id_p_motorizado, pm.ruta_imagen FROM $tabla v LEFT JOIN local_mesas lm ON v.id_mesa = lm.id_mesa  LEFT JOIN pedido_motorizado pm ON pm.id_venta = v.id_venta WHERE v.id_local='$id_local' AND v.estado !='Finalizado' AND v.atencion='Delivery' ORDER BY fecha_hora asc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlListarRecojo($tabla,$id_local){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla v LEFT JOIN local_mesas lm ON v.id_mesa = lm.id_mesa WHERE v.id_local='$id_local' AND v.estado !='Finalizado' AND v.atencion='Recojo' ORDER BY fecha_hora asc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
    
    static public function mdlListarTodasVentas($tabla, $id_local, $rol)
    {
        $q="";
        if ($rol!="Administrador General") {
            $q="AND v.id_local='$id_local'";
        }
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla v LEFT JOIN local_mesas lm ON v.id_mesa = lm.id_mesa WHERE v.estado !='Finalizado' $q AND v.prioridad = 'Normal' ORDER BY fecha_hora asc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarVentasPrioritarias($tabla, $id_local,$rol)
    {
        $q="";
        if ($rol!="Administrador General") {
            $q="AND v.id_local='$id_local'";
        }
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla v LEFT JOIN local_mesas lm ON v.id_mesa = lm.id_mesa WHERE v.estado !='Finalizado' $q AND v.prioridad = 'Preferencial' ORDER BY fecha_hora asc");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    
    static public function mdlListarDetalleVenta($id_venta)
    {
        $stmt = Conexion::conectar()->prepare(" SELECT * FROM detalle_venta WHERE id_venta='$id_venta'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
}
