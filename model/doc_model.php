<?php

require_once 'conexion.php';

class ModeloDocumento
{
    public static function mdlListarTablaDocumento($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    } 
    public static function mdlListarIdDoc($dni){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM documento_laboral where dni=$dni");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    } 
    static public function mdlRegistrarDocumento($tabla,$datos)
    {
        $db = Conexion::conectar();
        
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE dni=?");
        $consultar->execute([$datos['dni']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla (dni,cv) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['dni'],$datos['cv']]);

        if ($respuesta == true) {
            return "ok"; 
        } else {
            return "error";
        }
    }
    static public function mdlActualizarDocumento($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET dni=?,cv=? WHERE id_doc=?");
        $stmt->execute([$datos['dni'],$datos['cv'], $datos['id_doc']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlMostrarDocumento($tabla, $id_docA){
        $stmt =Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_doc='$id_docA'");
        $stmt->execute();
        $respuesta=$stmt->fetch();
        return $respuesta;
    }
    
    static public function mdlEliminarDocumento($tabla, $id_docE){
        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where dni=$id_docE");
        $stmt->execute();        
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }

}