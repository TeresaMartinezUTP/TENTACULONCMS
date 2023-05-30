<?php
require_once 'conexion.php';

class localempleadomodel
{
    public static function mdlListarLocalEmpleado($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT le.id_localemple , l.sede, e.nombres FROM $tabla le INNER JOIN empleado e ON le.id_empleado=e.id_empleado INNER JOIN local l ON le.id_local=l.id_local");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    public static function mdlRegistroLocalEmpleado($tabla, $datos)
    {
        
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empleado=?");
        $consultar->execute([$datos['id_empleado']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla(id_local,id_empleado) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['id_local'], $datos['id_empleado']]);

        if ($respuesta == true) {
            return "ok"; 
        } else {
            return "error";
        }
    }

    public static function mdlMostrarLocalEmpleado($tabla, $id_localemple){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_localemple='$id_localemple'");
        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public static function mdlActualizarLocalEmpleado($tabla, $datos)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empleado=? and id_localemple!=?");
        $consultar->execute([$datos['id_empleado'], $datos['id_localemple']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_local=?,id_empleado=? WHERE id_localemple=?");
        $stmt->execute( [$datos['id_local'], $datos['id_empleado'], $datos['id_localemple']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlEliminarLocalEmpleado($tabla, $id_localemple){
        $consultar = Conexion::conectar()->prepare("SELECT * FROM local_empleado le INNER JOIN usuarios u on le.id_localemple=u.id_localemple  where le.id_localemple='$id_localemple'");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'tieneus';
        }


        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_localemple ='$id_localemple'");
        $stmt->execute();        
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }
}
?>