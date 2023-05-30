<?php

class clientefreControlador{
    
    static public function ctrRegistrarClienFrecuente($tabla,$datos){

        $respuesta = clientefremodelo::mdlRegistrarClienFrecuente($tabla,$datos);
        return $respuesta;
    }
    static public function ctrListarTablaClienFrecuente($tabla){
        $respuesta = clientefremodelo::mdlListarTablaClienFrecuente($tabla);
        return $respuesta;
    }
    static public function ctrListarTablaClienFrecuentexSede($tabla,$sede){
        $respuesta = clientefremodelo::mdlListarTablaClienFrecuentexSede($tabla,$sede);
        return $respuesta;
    }
    static public function ctrMostrarClienFrecuenteID($tabla,$id_ClienFre)
    {
        $respuesta = clientefremodelo::mdlBuscarClienFrecuente($tabla,$id_ClienFre);
        return $respuesta;
    }
    static public function ctrActualizarClienFrecuente($tabla,$datos)
    {
        $respuesta = clientefremodelo::mdlActualizarClienFrecuente($tabla,$datos);
        return $respuesta;
    }    
    static public function ctrEliminarTablaClienFrecuente($tabla,$id_cliente_frecuente)
    {
        $respuesta = clientefremodelo::mdlEliminarClienFrecuente($tabla,$id_cliente_frecuente);
        return $respuesta;
    }
    static public function ctrListarmesasxlocal($tabla,$local)
    {
        $respuesta = clientefremodelo::mdlListarmesasxlocal($tabla,$local);
        return $respuesta;
    }
    static public function ctrListarmesasxlocaldisponibles($tabla,$local)
    {
        $respuesta = clientefremodelo::mdlListarmesasxlocaldisponibles($tabla,$local);
        return $respuesta;
    }
}
