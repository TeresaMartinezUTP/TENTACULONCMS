<?php

class inventariobebidascontroller{
    
    public static function ctrListarInventarioBebidas($tabla){
        $response = inventariobebidasmodel::mdlListarinventariobebidas($tabla);
        return $response;
    }
    public static function ctrListarBebidaStock($tabla){
        $respuesta = inventariobebidasmodel::mdlListarBebidaStock($tabla);
        return $respuesta;
    }
    public static function ctrListarInventarioBebidasxsede($tabla,$sede){
        $response = inventariobebidasmodel::mdlListarinventariobebidasxsede($tabla,$sede);
        return $response;
    }
    public static function ctrRegistrarInventarioBebida($tabla,$sede){
        $response = inventariobebidasmodel::mdlRegistrarinventariobebida($tabla,$sede);
        return $response;
    }
    public static function ctrMostrarInventarioBebida($tabla,$datos){
        $response = inventariobebidasmodel::mdlMostrarBebidaInventario($tabla,$datos);
        return $response;
    }
    public static function ctrActualizarInventarioBebida($tabla,$datos){
        $response = inventariobebidasmodel::mdlActualizarBebidaInventario($tabla,$datos);
        return $response;
    }
    static public function ctrEliminaBebidaInventario($tabla,$id_inventario){        
        $respuesta = inventariobebidasmodel::mdlEliminarBebidaInventario($tabla,$id_inventario);
        return $respuesta;
    }
}
?>