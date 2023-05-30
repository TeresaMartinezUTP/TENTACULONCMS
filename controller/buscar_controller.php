<?php
class ControllerBuscar{
    public static function ctrListarPlato($nombre,$id_local){

        $respuesta = ModeloBuscar::mdlListarPlato($nombre,$id_local);
        return $respuesta;
    }
    public static function ctrListarBebida($descripcion,$id_local){

        $respuesta = ModeloBuscar::mdlListarBebida($descripcion,$id_local);
        return $respuesta;
    }
}