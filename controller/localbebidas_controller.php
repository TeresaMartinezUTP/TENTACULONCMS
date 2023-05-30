<?php

class localbebidascontroller{
    
    public static function ctrListarLocalBebidas($tabla){
        $response = localbebidasmodel::mdlListarLocalbebidas($tabla);
        return $response;
    }
    public static function ctrRegistroLocalBebida($tabla, $datos){
        $response = localbebidasmodel::mdlRegistroLocalbebida($tabla, $datos);
        return $response;
    }
    
    public static function ctrMostrarLocalBebida($tabla,$id_localbebida){
        $response = localbebidasmodel::mdlMostrarLocalbebida($tabla,$id_localbebida);
        return $response;
    }

    public static function ctrActualizarLocalBebida($tabla,$datos){
        $response = localbebidasmodel::mdlActualizarLocalbebida($tabla,$datos);
        return $response;
    }

    public static function ctrEliminarLocalBebida($tabla,$id_localbebida){
        $response = localbebidasmodel::mdlEliminaLocalBebida($tabla,$id_localbebida);
        return $response;
    }
    public static function ctrListarBebidasLocalSelect($tabla,$sede){
        $response = localbebidasmodel::mdlListarLocalBebidasSelect($tabla,$sede);
        return $response;
    }
    public static function ctrCambiarEstado($tabla,$estado,$id_localbebida){
        $response = localbebidasmodel::mdlCambiarEstado($tabla,$estado,$id_localbebida);
        return $response;
    }
}
?>