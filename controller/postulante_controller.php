<?php

class postulantecontroller
{
    static public function ctrRegistroPostulante($tabla, $datos)
    {
        $respuesta = postulantemodel::mdlRegistrarPostulante($tabla, $datos);
        return $respuesta;
    }
    static public function ctrListarPostulante($tabla)
    {
        $respuesta = postulantemodel::mdlListarPostulante($tabla);
        return $respuesta;
    }
    static public function ctrMostrarPostulantexID($tabla,$id_postu)
    {
        $respuesta = postulantemodel::mdlMostrarPostulanteXID($tabla,$id_postu);
        return $respuesta;
    }  
    
    static public function ctrActualizarPostulante($tabla,$datos)
    {
        $respuesta = postulantemodel::mdlActualizarPostulante($tabla,$datos);
        return $respuesta;
    }
    static public function ctrEliminarTablaPostulante($id_postu)
    {
        $respuesta = postulantemodel::mdlEliminarPostulante($id_postu);
        return $respuesta;
    }
    static public function ctrCambiarEstado($tabla, $estado, $id_postu)
    {
        $respuesta = postulantemodel::mdlCambiarEstado($tabla, $estado, $id_postu);
        return $respuesta;
    } 

    static public function ctrAdjuntarArchivo($tabla,$datos)
    {
        $respuesta = postulantemodel::mdlAdjuntarArchivo($tabla, $datos);
        return $respuesta;
    }

    static public function ctrListarPostulanteAprobados($tabla)
    {
        $respuesta = postulantemodel::mdlListarPostulanteAprobados($tabla);
        return $respuesta;
    }  
    static public function ctrActualizarStatus($tabla, $status, $nombres)
    {
        $respuesta = postulantemodel::mdlActualizarStatus($tabla, $status, $nombres);
        return $respuesta;
    }
}
