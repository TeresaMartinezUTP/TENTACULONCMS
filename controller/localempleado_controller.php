<?php 

class localempleadocontroller{

    static public function ctrListarLocalEmpledo($tabla){        
        $respuesta = localempleadomodel::mdlListarLocalEmpleado($tabla);
        return $respuesta;
    }
    
    static public function ctrRegistrarLocalEmpleado($tabla, $datos){
        $respuesta = localempleadomodel::mdlRegistroLocalEmpleado($tabla,$datos);
        return $respuesta;
    }   

    public static function ctrMostrarLocalEmpleado($tabla, $id_localemple){
        $respuesta = localempleadomodel::mdlMostrarLocalEmpleado($tabla, $id_localemple);
        return $respuesta;
    }

    public static function ctrActualizarLocalEmpleado($tabla, $datos)
    {
        $respuesta = localempleadomodel::mdlActualizarLocalEmpleado($tabla, $datos);
        return $respuesta;
    }

    public static function ctrEliminarLocalEmpleado($tabla, $id_localempleado)
    {
        $respuesta = localempleadomodel::mdlEliminarLocalEmpleado($tabla, $id_localempleado);
        return $respuesta;
    }
}
?>