<?php
require_once 'conexion.php';
class empleadomodel
{
    static public function mdlRegistrarEmpleados($tabla, $datos)
    {
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE num_doc=? or correo=?");
        $consultar->execute([$datos['num_doc'], $datos['correo']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = $db->prepare("INSERT INTO $tabla(nombres,tipo_doc,num_doc,telefono,correo,area) VALUES (?,?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['nombres'], $datos['tipo_doc'], $datos['num_doc'], $datos['telefono'], $datos['correo'], $datos['area']]);

        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }
    static public function mdlListarEmpleados($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.* from $tabla e");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
    static public function mdlListarEmpleadosActivos($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.id_empleado , e.nombres, e.area from $tabla e WHERE estado='Activo'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlMostrarcorreoEmpleados($tabla, $id_empleado)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.correo, le.id_localemple, e.area from $tabla e INNER JOIN local_empleado le ON e.id_empleado=le.id_empleado WHERE e.id_empleado=$id_empleado");
        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }
    static public function mdlBuscarEmpleadoXID($id_empleado)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.* FROM empleado e  WHERE e.id_empleado='$id_empleado'");
        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }
    static public function mdlActualizarEmpleados($tabla,$datos)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE num_doc=? and id_empleado!=?");
        $consultar->execute([$datos['num_doc'],$datos['id_empleado']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres=?,tipo_doc=?,num_doc=?,telefono=?,correo=?,area=? WHERE id_empleado=?");
        $stmt->execute([$datos['nombres'], $datos['tipo_doc'], $datos['num_doc'], $datos['telefono'], $datos['correo'], $datos['area'], $datos['id_empleado']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }
    static public function mdlEliminarEmpleado($id_empleado)
    {
        $consultar = Conexion::conectar()->prepare("SELECT * FROM empleado e INNER JOIN local_empleado l on e.id_empleado=l.id_empleado  where e.id_empleado='$id_empleado'");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'tienele';
        }

        $emple = Conexion::conectar()->prepare("SELECT * from empleado where id_empleado='$id_empleado'");
        $emple->execute();
        $resultemple = $emple->fetchAll(PDO::FETCH_ASSOC);
        $dni= json_encode($resultemple[0]['num_doc']);

        $stmt = Conexion::conectar()->prepare("DELETE from empleado where id_empleado='$id_empleado'");
        $stmt->execute();

        $stmt2 = Conexion::conectar()->prepare("UPDATE postulante set estado='Retirado' where num_doc=$dni ");
        $stmt2->execute();

        if ($stmt = true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlCambiarEstado($tabla, $estado, $id_empleado)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = '$estado' WHERE id_empleado=$id_empleado");
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
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET documento=? WHERE id_empleado=?");
        $stmt->execute([$datos['documento'], $datos['id_empleado']]);
        if ($stmt == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlListarMotorizadosActivos($id_local)
    {
        $stmt = Conexion::conectar()->prepare("SELECT e.id_empleado , e.nombres, e.area, le.id_localemple FROM empleado e INNER JOIN local_empleado le ON e.id_empleado = le.id_empleado WHERE le.id_local = $id_local AND e.estado='Activo' AND e.area='Delivery'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}
