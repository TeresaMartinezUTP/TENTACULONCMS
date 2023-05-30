<?php
require_once 'conexion.php';

class incidenciamodel{

    static public function mdlListarIncidencias()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM incidencia");
        $stmt->execute();
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }

}

?>