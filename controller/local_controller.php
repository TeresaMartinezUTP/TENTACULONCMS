<?php 
class localcontroller{
    static public function ctrRegistrarLocal($tabla,$datos){
        $respuesta = localmodel::mdlRegistrarLocales($tabla,$datos);
        return $respuesta;
    }

    static public function ctrListarLocales($tabla){
        $respuesta = localmodel::mdlListarLocales($tabla);
        return $respuesta;
    }

    static public function ctrMostrarLocales($tabla,$id_local){
        $respuesta = localmodel::mdlMostrarLocales($tabla,$id_local);
        return $respuesta;
    }

    static public function ctrActualizarLocales($tabla,$datos){
        $respuesta = localmodel::mdlActualizarLocales($tabla,$datos);
        return $respuesta;        
    }

    static public function ctrEliminarLocales($tabla,$id_local){
        $respuesta = localmodel::mdlEliminarLocales($tabla,$id_local);
        return $respuesta;
    }
    static public function ctrListarLocalesActivos($tabla){
        $respuesta = localmodel::mdlListarLocalesActivos($tabla);
        return $respuesta;
    }

    static public function ctrListarLocalesEmpleado($tabla){
        $respuesta = localmodel::mdlListarLocalesEmpleado($tabla);
        return $respuesta;
    }
}
?>