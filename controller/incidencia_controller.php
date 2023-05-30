<?php

class incidenciacontroller
{
    static public function ctrListarIncidencias()
    {
        $respuesta = incidenciamodel::mdlListarIncidencias();
        return $respuesta;
    } 
}

?>