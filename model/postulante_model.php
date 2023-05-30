<?php
require_once 'conexion.php';
class postulantemodel
{
    static public function mdlRegistrarPostulante($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE num_doc=?");
        $consultar->execute([$datos['num_doc']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $consultar2 = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE correo=?");
        $consultar2->execute([$datos['correo']]);
        $result2 = $consultar2->fetch(PDO::FETCH_OBJ);
        if (!empty($result2)) {
            return 'repeatcorreo';
        }

        $stmt = $db->prepare("INSERT INTO $tabla(area,nombres,tipo_doc,num_doc,telefono,correo) VALUES (?,?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['area'], $datos['nombres'], $datos['tipo_doc'], $datos['num_doc'], $datos['telefono'], $datos['correo']]);
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }        
        $respuesta = null;
    }
    static public function mdlMostrarPostulanteXID($tabla,$id_postulante)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.* FROM $tabla p WHERE p.id_postulante =$id_postulante");
        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }
    static public function mdlActualizarPostulante($tabla,$datos)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE num_doc=? and id_postulante!=?");
        $consultar->execute([$datos['num_doc'],$datos['id_postulante']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $consultar2 = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE correo=? and id_postulante!=?");
        $consultar2->execute([$datos['correo'],$datos['id_postulante']]);
        $result2 = $consultar2->fetch(PDO::FETCH_OBJ);
        if (!empty($result2)) {
            return 'repeatcorreo';
        }

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET area=?,nombres=?,tipo_doc=?,num_doc=?,telefono=?,correo=? WHERE id_postulante=?");
        $stmt->execute([$datos['area'],$datos['nombres'], $datos['tipo_doc'], $datos['num_doc'], $datos['telefono'], $datos['correo'], $datos['id_postulante']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlListarPostulante($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.id_postulante,p.area,p.nombres,p.tipo_doc,p.num_doc,p.telefono,p.correo,p.estado,p.status FROM $tabla p");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }   

    static public function mdlEliminarPostulante($id_postu)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM postulante where id_postulante=$id_postu");
        $stmt->execute();
        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlCambiarEstado($tabla, $estado, $id_postulante)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = '$estado' WHERE id_postulante=$id_postulante");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }        
        $respuesta = null;
    }

static public function mdlAdjuntarArchivo($tabla,$datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET documento=? WHERE id_postulante=?");
        $stmt->execute([$datos['documento'], $datos['id_postulante']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarPostulanteAprobados($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.id_postulante,p.area,p.nombres,p.tipo_doc,p.num_doc,p.telefono,p.correo,p.estado FROM $tabla p WHERE estado='Aprobado' and status=0");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
    static public function mdlActualizarStatus($tabla, $status, $nombres)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = '$status' WHERE nombres='$nombres'");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }        
        $respuesta = null;
    }
}
