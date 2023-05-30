<?php

require_once 'conexion.php';

class ModeloBuscar
{
    public static function mdlListarPlato($nombre, $id_local)
    {
        $result = Conexion::conectar()->prepare("SELECT lp.id_local,pl.*, cp.nombre FROM platos pl INNER JOIN categoria_platos cp ON pl.id_categoria=cp.id_categoria INNER JOIN local_platos lp ON lp.id_plato=pl.id_plato WHERE pl.nombre_plato LIKE '$nombre%'AND lp.id_local='$id_local'");
        $result->execute();
        $respuesta = $result->fetchAll();
        return $respuesta;
    }
    public static function mdlListarBebida($descripcion, $id_local)
    {
        $result = Conexion::conectar()->prepare("SELECT * FROM bebidas b INNER JOIN local_bebidas lb ON b.id_bebida=lb.id_bebida WHERE b.descripcion LIKE '$descripcion%' AND lb.id_local='$id_local'");
        $result->execute();
        $respuesta = $result->fetchAll();
        return $respuesta;
    }
}
