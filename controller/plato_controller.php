<?php
class platoscontroller{
    static public function ctrRegistrarPlato($tabla,$datos)
    {
        $respuesta = platosmodel::mdlRegistrarPlato($tabla,$datos);
        return $respuesta;
    }

    static public function ctrListarPlato($tabla)
    {
        $respuesta = platosmodel::mdlListarPlato($tabla);
        return $respuesta;
    }

    static public function ctrListarPlatosActivos($tabla)
    {
        $respuesta = platosmodel::mdlListarPlatosActivos($tabla);
        return $respuesta;
    }

    static public function ctrMostrarPlato($tabla, $id_plato)
    {
        $respuesta = platosmodel::mdlMostrarPlato($tabla,$id_plato);
        return $respuesta;
    }

    static public function ctrActualizarPlato($tabla,$datos)
    {
        $respuesta = platosmodel::mdlActualizarPlato($tabla,$datos);
        return $respuesta;
    }

    static public function ctrEliminarPlato($tabla, $id_plato)
    {
        $respuesta = platosmodel::mdlEliminarPlato($tabla,$id_plato);
        return $respuesta;
    }
}
?>