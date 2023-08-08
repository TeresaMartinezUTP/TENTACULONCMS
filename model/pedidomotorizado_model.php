<?php
require_once 'conexion.php';

class pedido_motorizadomodel
{
    public static function mdlListarPedidosMotorizado($id_localemple)
    {
        $consultar = Conexion::conectar()->prepare("SELECT v.*, pm.*, null as nomemple FROM pedido_motorizado pm INNER JOIN venta v ON pm.id_venta = v.id_venta WHERE pm.estado = 'En proceso' AND pm.id_localemple = $id_localemple");
        $consultar->execute();
        $result = $consultar->fetchAll();
        return $result;
    }

    public static function mdlListarPedidosMotorizadoGeneral()
    {
        $consultar = Conexion::conectar()->prepare("SELECT v.*, pm.*, e.nombres as nomemple FROM pedido_motorizado pm INNER JOIN venta v ON pm.id_venta = v.id_venta INNER JOIN local_empleado le ON pm.id_localemple= le.id_localemple INNER JOIN empleado e ON le.id_empleado = e.id_empleado WHERE pm.estado = 'En proceso'");
        $consultar->execute();
        $result = $consultar->fetchAll();
        return $result;
    }

    public static function mdlListarPedidosMotorizadoGeneralxSede($sede)
    {
        if ($sede!="") {
            $sed='AND v.id_local='.$sede;
        }else{
            $sed='';
        }
        $consultar = Conexion::conectar()->prepare("SELECT v.*, pm.*, e.nombres as nomemple FROM pedido_motorizado pm INNER JOIN venta v ON pm.id_venta = v.id_venta  INNER JOIN local_empleado le ON pm.id_localemple= le.id_localemple INNER JOIN empleado e ON le.id_empleado = e.id_empleado WHERE pm.estado = 'En proceso' $sed");
        $consultar->execute();
        $result = $consultar->fetchAll();
        return $result;
    }

    public static function mdlListarDetallePedidosMotorizado($id_venta)
    {
        $consultar = Conexion::conectar()->prepare("SELECT v.cargo, dv.*,cf.descuento, b.descripcion, p.nombre_plato
        FROM detalle_venta dv LEFT JOIN platos p ON dv.id_localplato =  p.id_plato LEFT JOIN bebidas b ON b.id_bebida = dv.id_localbebida INNER JOIN venta v ON dv.id_venta = v.id_venta LEFT JOIN clientes_frecuentes cf ON v.id_cliente_frecuente = cf.id_cliente_frecuente WHERE dv.id_venta = $id_venta");
        $consultar->execute();
        $result = $consultar->fetchAll();
        
        return $result;
    }

    public static function mdlListaPedidoMotorizado($id_p_motorizado)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM pedido_motorizado WHERE id_p_motorizado = $id_p_motorizado");
        $consultar->execute();
        $result = $consultar->fetchAll();

        return $result;
    }

    public static function mdlListaPedidoMotorizadoxVenta($id_venta)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM pedido_motorizado WHERE id_venta = $id_venta");
        $consultar->execute();
        $result = $consultar->fetchAll();

        return $result;
    }
    
    public static function mdlRegistrarPedidoMotorizado($datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM pedido_motorizado WHERE id_venta=? ");
        $consultar->execute([$datos['id_venta']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO pedido_motorizado (id_venta) VALUES (?)");
        $respuesta = $stmt->execute($datos['id_venta']);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlActualizarPedidoMotorizado($id_p_motorizado, $datos)
    {
        $db = Conexion::conectar();
        $es="";
        $img="";
        if ($datos['estado']!="") {
            $es="estado='".$datos['estado']."' ,";
        }
        if ($datos['ruta_imagen']!="" || $datos['ruta_imagen']!=null) {
            $img="ruta_imagen='".$datos['ruta_imagen']."' ,";
        }
        if (isset($datos['finalizar']) && $datos['finalizar']==true) {
            $stmt = $db->prepare("UPDATE pedido_motorizado SET estado=? WHERE id_p_motorizado = $id_p_motorizado");
            $respuesta = $stmt->execute([$datos['estado']]);
        } else {
            $stmt = $db->prepare("UPDATE pedido_motorizado SET $es $img descripcion=?, id_incidencia=? WHERE id_p_motorizado = $id_p_motorizado");
            $respuesta = $stmt->execute([$datos['descripcion'], $datos['id_incidencia']]);
        }
        
        if ($respuesta == true) {
            return "ok";
        } else {    
            return "error";
        }
    }

    public static function mdlActualizarEstadoPedidoMotorizado($datos)
    {
        $db = Conexion::conectar();

        $stmt = $db->prepare("UPDATE pedido_motorizado SET estado='En proceso', id_localemple=? WHERE id_venta= ?");
        $respuesta = $stmt->execute([$datos['id_localemple'], $datos['id_venta']]);

        if ($respuesta == true) {
            return "ok";
        } else {    
            return "error";
        }
    }

    public static function mdlFinalizarVenta($id_venta)
    {
        $db = Conexion::conectar();

        $fecha_actual= 
        $stmt = $db->prepare("UPDATE venta SET estado = 'Finalizado', fecha_hora_entrega = current_timestamp  WHERE id_venta = $id_venta");
        $respuesta = $stmt->execute();
        
        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlListarPedidosEntregados($id_local,$rol,$id_empleado) //aqui
    {
        if($rol =="Delivery motorizado")
        {
            $consultar = Conexion::conectar()->prepare("SELECT v.*, dv.*,i.*, pm.estado as pm_estado ,pm.descripcion as pm_descripcion, e.nombres, cd.nombre_completo FROM detalle_venta dv INNER JOIN venta v ON dv.id_venta = v.id_venta LEFT JOIN clientes_frecuentes cd ON v.id_cliente_frecuente = cd.id_cliente_frecuente INNER JOIN pedido_motorizado pm ON v.id_venta = pm.id_venta INNER JOIN local_empleado le ON pm.id_localemple = le.id_localemple INNER JOIN empleado e ON le.id_empleado = e.id_empleado LEFT JOIN incidencia i ON i.id_incidencia = pm.id_incidencia WHERE v.estado = 'Finalizado' AND e.id_empleado=$id_empleado AND DATE(v.fecha_hora_entrega)=CURRENT_DATE() GROUP BY(v.id_venta)");
            $consultar->execute();
            $result = $consultar->fetchAll();
        }
        else if($rol =="Administrador"||$rol =="Counte en caja")
        {
            $consultar = Conexion::conectar()->prepare("SELECT v.*, dv.*,i.*, pm.estado as pm_estado ,pm.descripcion as pm_descripcion, e.nombres, cd.nombre_completo FROM detalle_venta dv INNER JOIN venta v ON dv.id_venta = v.id_venta LEFT JOIN clientes_frecuentes cd ON v.id_cliente_frecuente = cd.id_cliente_frecuente INNER JOIN pedido_motorizado pm ON v.id_venta = pm.id_venta INNER JOIN local_empleado le ON pm.id_localemple = le.id_localemple INNER JOIN empleado e ON le.id_empleado = e.id_empleado LEFT JOIN incidencia i ON i.id_incidencia = pm.id_incidencia WHERE v.estado = 'Finalizado' AND le.id_local=$id_local GROUP BY(v.id_venta)");
            $consultar->execute();
            $result = $consultar->fetchAll();
        }
        else if($rol =="Administrador General"){
            $consultar = Conexion::conectar()->prepare("SELECT v.*, dv.*,i.*, pm.estado as pm_estado ,pm.descripcion as pm_descripcion, e.nombres, cd.nombre_completo FROM detalle_venta dv INNER JOIN venta v ON dv.id_venta = v.id_venta LEFT JOIN clientes_frecuentes cd ON v.id_cliente_frecuente = cd.id_cliente_frecuente INNER JOIN pedido_motorizado pm ON v.id_venta = pm.id_venta INNER JOIN local_empleado le ON pm.id_localemple = le.id_localemple INNER JOIN empleado e ON le.id_empleado = e.id_empleado LEFT JOIN incidencia i ON i.id_incidencia = pm.id_incidencia GROUP BY(v.id_venta)");
            $consultar->execute();
            $result = $consultar->fetchAll();
        }
        else{

        }
        return $result;
    }

    public static function mdlListarPedidosEntregadosporId($id_venta)
    {   
        $consultar = Conexion::conectar()->prepare("SELECT v.*, dv.*, pm.estado as pm_estado, cd.nombre_completo FROM detalle_venta dv INNER JOIN venta v ON dv.id_venta = v.id_venta LEFT JOIN clientes_frecuentes cd ON v.id_cliente_frecuente = cd.id_cliente_frecuente INNER JOIN pedido_motorizado pm ON v.id_venta = pm.id_venta  WHERE v.estado = 'Finalizado' AND v.id_venta = $id_venta");
        $consultar->execute();
        $result = $consultar->fetchAll();

        return $result;
    }

    public static function mdlListarPedidosEntregadosxSede($sede)
    {
        if ($sede!="") {
            $sed='WHERE v.id_local='.$sede;
        }else{
            $sed='';
        }
        $consultar = Conexion::conectar()->prepare("SELECT v.*, dv.*,i.*, pm.estado as pm_estado ,pm.descripcion as pm_descripcion, e.nombres, cd.nombre_completo FROM detalle_venta dv INNER JOIN venta v ON dv.id_venta = v.id_venta LEFT JOIN clientes_frecuentes cd ON v.id_cliente_frecuente = cd.id_cliente_frecuente INNER JOIN pedido_motorizado pm ON v.id_venta = pm.id_venta INNER JOIN local_empleado le ON pm.id_localemple = le.id_localemple INNER JOIN empleado e ON le.id_empleado = e.id_empleado LEFT JOIN incidencia i ON i.id_incidencia = pm.id_incidencia $sed GROUP BY(v.id_venta)");
        $consultar->execute();
        $result = $consultar->fetchAll();
        return $result;
    }
}
