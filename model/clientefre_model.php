<?php
require_once 'conexion.php';
class clientefremodelo
{
    static public function mdlRegistrarClienFrecuente($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_completo=? AND isdeleted ='0'");
        $consultar->execute([$datos['nombre_completo']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla(nombre_completo,telefono,correo,descuento,id_local) VALUES (?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['nombre_completo'], $datos['telefono'], $datos['correo'], $datos['descuento'], $datos['id_local']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }

    static public function mdlBuscarClienFrecuente($tabla, $id_cliente_frecuente)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_cliente_frecuente ='$id_cliente_frecuente '");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
        $respuesta->close();
        $respuesta = null;
    }

    static public function mdlListarTablaClienFrecuente($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla cf INNER JOIN local lc ON cf.id_local=lc.id_local WHERE cf.isdeleted='0'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
    static public function mdlListarTablaClienFrecuentexSede($tabla, $sede)
    {
        $stmt = Conexion::conectar()->prepare("SELECT cf.*, lc.sede  FROM $tabla cf INNER JOIN local lc ON cf.id_local=lc.id_local WHERE cf.id_local='$sede' AND isdeleted='0' AND estado='Activo'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
    static public function mdlActualizarClienFrecuente($tabla, $datos)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_completo=? AND isdeleted ='0' AND id_cliente_frecuente!=?");
        $consultar->execute([$datos['nombre_completo'],$datos['id_cliente_frecuente']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_completo=?,telefono=?,correo=?, descuento=?,id_local=?,estado=? WHERE id_cliente_frecuente=?");
        $respuesta = $stmt->execute([$datos['nombre_completo'], $datos['telefono'], $datos['correo'], $datos['descuento'],$datos['id_local'], $datos['estado'], $datos['id_cliente_frecuente']]);
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }
    static public function mdlEliminarClienFrecuente($tabla, $id_cliente_frecuente)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET isdeleted ='1' where id_cliente_frecuente='$id_cliente_frecuente'");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }
    static public function mdlListarmesasxlocal($tabla,$local)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_local='$local'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
    static public function mdlListarmesasxlocaldisponibles($tabla,$local)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id_mesa,nombre_mesa FROM $tabla WHERE NOT EXISTS (SELECT * FROM venta WHERE local_mesas.id_mesa=venta.id_mesa AND venta.estado ='Pendiente') AND id_local='$local';
        ");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }
}
