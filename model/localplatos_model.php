<?php
require_once 'conexion.php';
class localplatosmodel{
    public static function mdlListarLocalplatos($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT pl.id_localplato,p.nombre_plato,l.sede,pl.estado
        FROM $tabla pl INNER JOIN platos p ON pl.id_plato=p.id_plato INNER JOIN local l ON pl.id_local=l.id_local");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    public static function mdlRegistrarPlatoLocal($tabla, $datos){
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_local=? and id_plato=? ");
        $consultar->execute([$datos['id_local'], $datos['id_plato']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla(id_plato,id_local) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['id_plato'],$datos['id_local']]);

        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlMostrarPlatoLocal($tabla,$id_localplato){
        $stmt =Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_localplato='$id_localplato'");
        $stmt->execute();
        $respuesta=$stmt->fetch();
        return $respuesta;
    }

    public static function mdlActualizarPlatoLocal($tabla,$datos){
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_local=? and id_plato=? and id_localplato!=?");
        $consultar->execute([$datos['id_local'], $datos['id_plato'],$datos['id_localplato']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_plato=?,id_local=?, estado=? WHERE id_localplato=?");
        $respuesta = $stmt->execute([$datos['id_plato'],$datos['id_local'],$datos['estado'] ,$datos['id_localplato']]);
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlEliminarPlatoLocal($tabla, $id_localplato){
        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_localplato=$id_localplato");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }
}
?>
