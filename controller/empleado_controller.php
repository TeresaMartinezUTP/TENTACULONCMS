<?php

class empleadoscontroller
{
    static public function ctrRegistroEmpleados($tabla, $datos)
    {
        $respuesta = empleadomodel::mdlRegistrarEmpleados($tabla, $datos);
        return $respuesta;
    }

    static public function ctrListarEmpleados($tabla)
    {
        $respuesta = empleadomodel::mdlListarEmpleados($tabla);
        return $respuesta;
    }   
    static public function ctrActualizarEmpleados($tabla,$datos)
    {        
        $respuesta = empleadomodel::mdlActualizarEmpleados($tabla, $datos);
        return $respuesta;
    }
    static public function ctrEliminarTablaEmpleados($id_tipoemple)
    {
        $respuesta = empleadomodel::mdlEliminarEmpleado($id_tipoemple);
        return $respuesta;
    }

    static public function ctrCambiarEstado($tabla, $estado, $id_empleado)
    {
        $respuesta = empleadomodel::mdlCambiarEstado($tabla, $estado, $id_empleado);
        return $respuesta;
    }

    static public function ctrAdjuntarArchivo($tabla, $datos)
    {
        $respuesta = empleadomodel::mdlAdjuntarArchivo($tabla, $datos);
        return $respuesta;
    }

    static public function ctrBuscarEmpleadosxID($id_empleado)
    {
        $respuesta = empleadomodel::mdlBuscarEmpleadoXID($id_empleado);
        return $respuesta;
    }
    static public function ctrListarEmpleadosActivos($tabla)
    {
        $respuesta = empleadomodel::mdlListarEmpleadosActivos($tabla);
        return $respuesta;
    }
    static public function ctrMostrarcorreoEmpleados($tabla, $id_empleado)
    {
        $respuesta = empleadomodel::mdlMostrarcorreoEmpleados($tabla, $id_empleado);
        return $respuesta;
    }
    static public function ctrListarMotorizadosActivos($id_local)
    {
        $respuesta = empleadomodel::mdlListarMotorizadosActivos($id_local);
        return $respuesta;
    }
}
