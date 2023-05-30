<?php 

class categoriaplatoscontroller{
    static public function ctrRegistrarCategoriaPlato($tabla,$datos)
    {
        $respuesta = categoriaplatosmodel::mdlRegistrarCategoriaPlato($tabla,$datos);
        return $respuesta;
    }

    static public function ctrListarCategoriaPlato($tabla){
        $respuesta = categoriaplatosmodel::mdlListarCategoriaPlato($tabla);
        return $respuesta;
    }

    static public function ctrMostrarCategoriaPlato($tabla,$id_cateplato){
        $respuesta = categoriaplatosmodel::mdlMostrarCategoriaPlato($tabla,$id_cateplato);
        return $respuesta;
    }

    static public function ctrActualizarCategoriaPlato($tabla,$datos)
    {
        $respuesta = categoriaplatosmodel::mdlActualizarCategoriaPlato($tabla,$datos);
        return $respuesta;
    }

    static public function ctrEliminarCategoriaPlato($tabla,$id_cateplato)
    {
        $respuesta = categoriaplatosmodel::mdlEliminarCategoriaPlato($tabla,$id_cateplato);
        return $respuesta;
    }

    static public function ctrListarCategoriaPlatoActivos($tabla){
        $respuesta = categoriaplatosmodel::mdlListarCategoriaPlatoActivos($tabla);
        return $respuesta;
    }
}
?>