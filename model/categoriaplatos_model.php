<?php
require_once 'conexion.php';

class categoriaplatosmodel{
    static public function mdlRegistrarCategoriaPlato($tabla,$datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre = ?");
        $consultar->execute([$datos['nombre']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla (nombre,descripcion,imagen) VALUES (?,?,?)");
        $respuesta = $stmt->execute([$datos['nombre'],$datos['descripcion'], $datos['imagen']]);
        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarCategoriaPlato($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlMostrarCategoriaPlato($tabla,$id_cateplato){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoria='$id_cateplato'");
        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }

    static public function mdlActualizarCategoriaPlato($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=?,descripcion=?, imagen=?, status=? WHERE id_categoria=?");
        $stmt->execute([$datos['nombre'],$datos['descripcion'], $datos['imagen'], $datos['status'], $datos['id_categoria']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlEliminarCategoriaPlato($tabla,$id_cateplato)
    {
        $db = Conexion::conectar();
        $consultar = $db->prepare("SELECT cp.id_categoria FROM $tabla cp INNER JOIN platos pl ON cp.id_categoria=pl.id_categoria WHERE cp.id_categoria=$id_cateplato");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usado';
        }

        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_categoria=$id_cateplato");
        $stmt->execute();
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarCategoriaPlatoActivos($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status = 'Activo'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}

?>