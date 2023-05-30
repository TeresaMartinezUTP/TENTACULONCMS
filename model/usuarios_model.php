<?php
require_once 'conexion.php';
class usuariosmodel
{
    static public function mdlRegistrarUsuarios($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empleado=?");
        $consultar->execute([$datos['id_empleado']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }
        $stmt = $db->prepare("INSERT INTO $tabla(contraseña,rol,id_empleado,id_localemple) VALUES (?,?,?,?)");
        $respuesta = $stmt->execute([$datos['contraseña'], $datos['rol'], $datos['id_empleado'], $datos['id_localemple']]);
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }

    static public function mdlListarUsuarios($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.id_usuario,u.rol,u.id_localemple,u.contraseña, u.fecha ,e.id_empleado,e.nombres,e.correo,e.estado, lc.sede,lc.direccion FROM $tabla u 
        INNER JOIN empleado e ON u.id_empleado=e.id_empleado 
        INNER JOIN local_empleado lce ON lce.id_localemple=u.id_localemple
        INNER JOIN local lc ON lc.id_local=lce.id_local");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlMostrarUsuarios($tabla, $id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.id_usuario,u.rol,u.id_localemple,u.contraseña, u.fecha ,e.id_empleado,e.nombres,e.correo,e.estado,lce.id_localemple, lc.sede,lc.direccion FROM $tabla u 
        INNER JOIN empleado e ON u.id_empleado=e.id_empleado 
        INNER JOIN local_empleado lce ON u.id_localemple=lce.id_localemple
        INNER JOIN local lc ON lc.id_local=lce.id_local WHERE u.id_usuario ='$id_usuario'");

        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
        $respuesta->close();
        $respuesta = null;
    }

    static public function mdlActualizarUsuarios($tabla, $datos)
    {
        if ($datos['contraseña'] == "" || $datos['contraseña'] == null) {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_empleado=?,rol=?,id_localemple=? WHERE id_usuario=?");
            $respuesta = $stmt->execute([$datos['id_empleado'], $datos['rol'], $datos['id_localemple'], $datos['id_usuario']]);
            if ($respuesta) {
                return "ok";
            } else {
                return "error";
            }
            $respuesta = null;
        } else {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_empleado=?,rol=?,contraseña=?,id_localemple=? WHERE id_usuario=?");
            $respuesta = $stmt->execute([$datos['id_empleado'], $datos['rol'], $datos['contraseña'], $datos['id_localemple'], $datos['id_usuario']]);
            if ($respuesta) {
                return "ok";
            } else {
                return "error";
            }
            $respuesta = null;
        }
    }

    static public function mdlEliminarUsuarios($tabla, $id_usuario)
    {
        $stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_usuario ='$id_usuario'");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }

    static public function mdlListarUsuariosxSede($tabla, $sede)
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.id_usuario,u.rol,u.id_local,u.contraseña,e.nombres,e.correo,e.estado, lc.sede,lc.direccion FROM $tabla u 
        INNER JOIN empleado e ON u.id_empleado=e.id_empleado 
        INNER JOIN local lc ON u.id_local=lc.id_local WHERE lc.sede='$sede'");

        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}
