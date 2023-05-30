<?php
require_once 'conexion.php';
class bebidasmodel
{
    public static function mdlRegistrarbebida($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE descripcion=?");
        $consultar->execute([$datos['descripcion']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla (marca,precio,descripcion,ruta_imagen) VALUES (?,?,?,?)");
        $respuesta = $stmt->execute([$datos['marca'], $datos['precio'], $datos['descripcion'], $datos['ruta_imagen']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlListarbebidas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    public static function mdlActualizarbebida($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca=?,precio=?,descripcion=?,ruta_imagen=?,status=? WHERE id_bebida=?");
        $stmt->execute([$datos['marca'], $datos['precio'], $datos['descripcion'], $datos['ruta_imagen'], $datos['status'], $datos['id_bebida']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlMostrarbebida($tabla, $id_bebida)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_bebida='$id_bebida'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }

    public static function mdlEliminarbebida($tabla, $id_bebida)
    {
        $db = Conexion::conectar();
        $consultar = $db->prepare("SELECT b.id_bebida FROM $tabla b INNER JOIN local_bebidas lcb ON lcb.id_bebida=b.id_bebida WHERE b.id_bebida=$id_bebida");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usado';
        }

        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_bebida=$id_bebida");
        $stmt->execute();
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlListarbebidasactivas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status='Activo'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

}
