<?php
class bebidascontroller{
    public static function ctrRegistrarBebida($tabla,$datos)
    {
        $respuesta = bebidasmodel::mdlRegistrarbebida($tabla,$datos);
        return $respuesta;
    }

    public static function ctrListarBebida($tabla){
        $respuesta = bebidasmodel::mdlListarbebidas($tabla);
        return $respuesta;
    }

    public static function ctrActualizarBebida($tabla,$datos){        
        $respuesta = bebidasmodel::mdlActualizarbebida($tabla, $datos);
        return $respuesta;
    }
    public static function ctrMostrarBebida($tabla,$id_bebida){        
        $respuesta = bebidasmodel::mdlMostrarbebida($tabla,$id_bebida);
        return $respuesta;
    }

    public static function ctrEliminaBebida($tabla,$id_bebida){        
        $respuesta = bebidasmodel::mdlEliminarbebida($tabla,$id_bebida);
        return $respuesta;
    }
    public static function ctrListarBebidaActivas($tabla){
        $respuesta = bebidasmodel::mdlListarbebidasactivas($tabla);
        return $respuesta;
    }
    
}
?>