<?php 
require_once 'conexion.php';

class platosmodel{

    static public function mdlRegistrarPlato($tabla,$datos)
    {
        $db = Conexion::conectar();
        $consulta = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_plato = ?");
        $consulta->execute([$datos['nombre_plato']]);
        $result = $consulta->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {

            return 'repeat';
        }
        $stmt = $db->prepare("INSERT INTO $tabla (nombre_plato,descripcion,precio,imagen,id_categoria) VALUES (?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['nombre_plato'], $datos['descripcion'], $datos['precio'], $datos['imagen'], $datos['id_categoria']]);
        if ($respuesta == true){
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarPlato($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT pl.*, cp.nombre FROM $tabla pl INNER JOIN categoria_platos cp ON pl.id_categoria=cp.id_categoria");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlListarPlatosActivos($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status='Activo'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlMostrarPlato($tabla, $id_plato)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_plato='$id_plato'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
    }

    static public function mdlActualizarPlato($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_plato=?,descripcion=?,precio=?,imagen=?,status=?,id_categoria=? WHERE id_plato=?");
        $stmt->execute([$datos['nombre_plato'], $datos['descripcion'], $datos['precio'], $datos['imagen'], $datos['status'], $datos['id_categoria'], $datos['id_plato']]);
        if ($stmt) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlEliminarPlato($tabla, $id_plato)
    {
        $db = Conexion::conectar();
        $consultar = $db->prepare("SELECT pl.id_plato FROM $tabla pl INNER JOIN local_platos lcp ON pl.id_plato=lcp.id_plato WHERE pl.id_plato=$id_plato");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usado';
        }

        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_plato=$id_plato");
        $respuesta=$stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }
}
?>