<?php

class localmesacontroller
{
    static public function ctrRegistrarLocalMesa($tabla, $datos)
    {
        $respuesta = localmesamodel::mdlRegistrarLocalMesa($tabla, $datos);
        return $respuesta;
    }
    static public function ctrListarLocalMesa($tabla)
    {
        $respuesta = localmesamodel::mdlListarLocalMesa($tabla);
        return $respuesta;
    }

    static public function ctrMostrarLocalMesa($tabla,$id_mesa)
    {
        $respuesta = localmesamodel::mdlMostrarLocalMesa($tabla,$id_mesa);
        return $respuesta;
    }
    static public function ctrActualizarLocalMesa($tabla,$datos)
    {        
        $respuesta = localmesamodel::mdlActualizarLocalMesa($tabla, $datos);
        return $respuesta;
    }
    static public function ctrEliminarLocalMesa($tabla,$id_mesa)
    {
        $respuesta = localmesamodel::mdlEliminarLocalMesa($tabla, $id_mesa);
        return $respuesta;
    }    
}
