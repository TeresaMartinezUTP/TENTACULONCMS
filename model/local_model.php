<?php require_once 'conexion.php';

class localmodel{
    static public function mdlRegistrarLocales($tabla,$datos){
        $db = Conexion::conectar();
        $consultar = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE sede=?");
        $consultar->execute([$datos['sede']]);
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'repeat';
        }
        $stmt = $db->prepare("INSERT INTO $tabla(direccion,sede) VALUES (?,?)");
        $respuesta = $stmt->execute([$datos['direccion'],$datos['sede']]);
        if ($respuesta) {
            return "ok";
        } else {
            return "error";
        }
        $respuesta = null;
    }

    static public function mdlListarLocales($tabla){
        $stmt= Conexion::conectar()->prepare("SELECT * FROM $tabla  ");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlMostrarLocales($tabla,$id_local){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_local=$id_local");
        $stmt->execute();
        $respuesta = $stmt->fetch(PDO::FETCH_OBJ);
        return $respuesta;
        $respuesta->close();
        $respuesta = null;
    }

    static public function mdlActualizarLocales($tabla,$datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET direccion=?, sede=?, status=? WHERE id_local=?");
        $respuesta = $stmt->execute([$datos['direccion'],$datos['sede'],$datos['status'],$datos['id_local']]);
        if($respuesta){
            return 'ok';
        }else{
            return 'error';
        }
        $respuesta = null;
        
    }

    static public function mdlEliminarLocales($tabla,$id_local){
        $db= Conexion::conectar();
        $consultar = $db->prepare("SELECT lc.id_local from $tabla lc INNER JOIN local_empleado le ON lc.id_local = le.id_local INNER JOIN usuarios us ON le.id_localemple = us.id_localemple WHERE lc.id_local=$id_local");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usadoUser';
        }

        $consultar = $db->prepare("SELECT lc.id_local from $tabla lc INNER JOIN local_mesas lm ON lc.id_local = lm.id_local WHERE lc.id_local=$id_local");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usadoLm';
        }

        $consultar = $db->prepare("SELECT lc.id_local from $tabla lc INNER JOIN local_platos lp ON lc.id_local = lp.id_local WHERE lc.id_local=$id_local");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usadoLp';
        }
        
        $consultar = $db->prepare("SELECT lc.id_local from $tabla lc INNER JOIN local_bebidas lb ON lc.id_local = lb.id_local WHERE lc.id_local=$id_local");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usadoLb';
        }

        $consultar = $db->prepare("SELECT lc.id_local from $tabla lc INNER JOIN local_empleado le ON lc.id_local = le.id_local WHERE lc.id_local=$id_local");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usadoLe';
        }

        $consultar = $db->prepare("SELECT lc.id_local from $tabla lc INNER JOIN clientes_frecuentes cf ON lc.id_local = cf.id_local WHERE lc.id_local=$id_local");
        $consultar->execute();
        $result = $consultar->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return 'usadoCf';
        }

        $stmt = Conexion::conectar()->prepare("DELETE from $tabla WHERE id_local=$id_local");
        $respuesta = $stmt->execute();
        if($respuesta){
            return 'ok';
        }else{
            return 'error';
        }
        $respuesta = null;
    }

    static public function mdlListarLocalesActivos($tabla){
        $stmt= Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status='Activo' and sede!='SD-00'");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    static public function mdlListarLocalesEmpleado($tabla){
        $stmt= Conexion::conectar()->prepare("SELECT lce.id_localemple,lc.direccion,lc.sede FROM $tabla lce INNER JOIN local lc ON lc.id_local=lce.id_local /* WHERE status='Activo' */");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}
?>