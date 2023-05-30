<?php
require_once 'conexion.php';
class loginmodelo
{
    static public function mdlsignInUser($user,$pass){
        $statement = Conexion::conectar()->prepare("SELECT u.id_empleado,u.id_usuario,u.contraseña,u.id_localemple,e.nombres,e.correo,e.estado,lc.id_local,lc.sede,u.rol as nombre 
        from usuarios u 
        INNER JOIN empleado e ON u.id_empleado= e.id_empleado 
        INNER JOIN local_empleado lce ON u.id_localemple=lce.id_localemple
        INNER JOIN local lc ON lc.id_local=lce.id_local
        WHERE e.correo='$user'");
        $statement->execute();
        $response=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $response;

    }
}