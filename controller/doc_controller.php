<?php
class ControllerDocumento{
    public static function ctrListarDocumento($tabla){

        $respuesta = ModeloDocumento::mdlListarTablaDocumento($tabla);
        return $respuesta;
    }
    public static function ctrListarDoc($dni){
        $respuesta = ModeloDocumento::mdlListarIdDoc($dni);
        return $respuesta;

    }
    static public function ctrRegistrarDocumento($tabla,$datos)
    {
        $respuesta =ModeloDocumento::mdlRegistrarDocumento($tabla,$datos);
        return $respuesta;
    }
    static public function ctrActualizarDocumento($tabla,$datos){        
        $respuesta = ModeloDocumento::mdlActualizarDocumento($tabla, $datos);
        return $respuesta;
    }
    static public function ctrMostrarDocumento($tabla,$id_docA){        
        $respuesta = ModeloDocumento::mdlMostrarDocumento($tabla,$id_docA);
        return $respuesta;
    }

    static public function ctrEliminaDocumento($tabla,$id_docE){        
        $respuesta = ModeloDocumento::mdlEliminarDocumento($tabla,$id_docE);
        return $respuesta;
    }
}
