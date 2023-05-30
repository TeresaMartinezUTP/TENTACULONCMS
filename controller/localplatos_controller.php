<?php
class platolocalcontroller{

    public static function ctrListarPlatolocal($tabla){
        $respuesta = localplatosmodel::mdlListarLocalplatos($tabla);
        return $respuesta;
    }

    public static function ctrRegistrarPlatolocal($tabla,$datos){
        $respuesta = localplatosmodel::mdlRegistrarPlatoLocal($tabla,$datos);
        return $respuesta;
    }

    public static function ctrMostrarPlatoLocal($tabla,$id_localplato){        
        $respuesta = localplatosmodel::mdlMostrarPlatoLocal($tabla,$id_localplato);
        return $respuesta;
    }

    public static function ctrActualizarPlatoLocal($tabla,$datos){
        $respuesta = localplatosmodel::mdlActualizarPlatoLocal($tabla, $datos);
        return $respuesta;
    }

    public static function ctrEliminarPlatoLocal($tabla,$id_localplato)
    {        
        $respuesta = localplatosmodel::mdlEliminarPlatoLocal($tabla,$id_localplato);
        return $respuesta;
    }
}