<?php

require_once 'conexion.php';
class localmesamodel{
    static public function mdlRegistrarLocalMesa($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_mesa=? and id_local=?");
        $consultar->execute([$datos['nombre_mesa'],$datos['id_local']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }
        $stmt = $db->prepare("INSERT INTO $tabla(nombre_mesa,id_local) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['nombre_mesa'], $datos['id_local']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }

    static public function mdlListarLocalMesa($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT lm.*, CONCAT(lc.sede,' ',lc.direccion) as local FROM $tabla lm INNER JOIN local lc ON lm.id_local=lc.id_local");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlMostrarLocalMesa($tabla, $id_mesa)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE id_mesa=$id_mesa");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }
    static public function mdlActualizarLocalMesa($tabla, $datos)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_mesa=? and id_local=? and id_mesa!=?");
        $consultar->execute([$datos['nombre_mesa'], $datos['id_local'], $datos['id_mesa']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_mesa=?,id_local=? ,estado=? WHERE id_mesa=?");
        $stmt->execute([$datos['nombre_mesa'], $datos['id_local'], $datos['estado'] ,$datos['id_mesa'] ]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlEliminarLocalMesa($tabla, $id_mesa)
    {
        
        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_mesa=$id_mesa");
        $stmt->execute();
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }
}