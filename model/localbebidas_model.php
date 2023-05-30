<?php
require_once 'conexion.php';
class localbebidasmodel
{
    public static function mdlListarLocalbebidas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT lb.id_localbebida, l.sede, CONCAT(b.marca, ' ', b.descripcion) as bebida, lb.estado FROM $tabla lb INNER JOIN bebidas b ON lb.id_bebida=b.id_bebida INNER JOIN local l ON lb.id_local=l.id_local");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    public static function mdlRegistroLocalbebida($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_local=? and id_bebida=?");
        $consultar->execute([$datos['id_local'], $datos['id_bebida']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla(id_local,id_bebida) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['id_local'], $datos['id_bebida']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlMostrarLocalbebida($tabla, $id_localbebida)
    {
        $stmt = Conexion::conectar()->prepare("SELECT bl.id_localbebida,b.descripcion,l.sede,bl.estado,l.id_local,b.id_bebida FROM $tabla bl INNER JOIN bebidas b ON bl.id_bebida=b.id_bebida INNER JOIN local l ON bl.id_local=l.id_local WHERE bl.id_localbebida='$id_localbebida'");
        $stmt->execute();
        $respuesta = $stmt->fetch();
        return $respuesta;
        $respuesta->close();
        $respuesta = null;
    }

    public static function mdlActualizarLocalbebida($tabla, $data)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_local=? and id_bebida=? and id_localbebida!=?");
        $consultar->execute([$data['id_local'], $data['id_bebida'], $data['id_localbebida']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("UPDATE $tabla SET id_local=?,id_bebida=?,estado=? WHERE id_localbebida=?");
        $respuesta = $stmt->execute([$data['id_local'], $data['id_bebida'], $data['estado'],$data['id_localbebida']]);
        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;

    }

    public static function mdlEliminaLocalBebida($tabla, $id_localbebida)
    {

        $db = Conexion::conectar();
        $consultar = $db->prepare("SELECT lb.id_localbebida FROM $tabla lb INNER JOIN inventario_bebidas ivb ON lb.id_localbebida=$id_localbebida");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usado';
        }

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_localbebida='$id_localbebida'");
        $respuesta = $stmt->execute();
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarLocalBebidasSelect($tabla,$sede)
    {
        $stmt = Conexion::conectar()->prepare("SELECT bl.id_localbebida,b.marca,b.descripcion,l.sede,bl.estado FROM $tabla bl INNER JOIN bebidas b ON bl.id_bebida=b.id_bebida INNER JOIN local l ON bl.id_local=l.id_local WHERE l.sede='$sede'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        return $respuesta;
    }

    static public function mdlCambiarEstado($tabla,$estado,$id_localbebida){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado='$estado' WHERE id_localbebida='$id_localbebida'");
        $stmt->execute();
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
}
?>
