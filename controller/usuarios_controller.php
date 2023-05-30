<?php 
class usuarioscontroller{
    static public function ctrRegistrarUsuarios($tabla,$datos){
        $respuesta = usuariosmodel::mdlRegistrarUsuarios($tabla,$datos);
        return $respuesta;
    }

    static public function ctrListarUsuarios($tabla){
        $respuesta = usuariosmodel::mdlListarUsuarios($tabla);
        return $respuesta;
    }

    static public function ctrMostrarUsuarios($tabla,$id_usuario){
        $respuesta = usuariosmodel::mdlMostrarUsuarios($tabla,$id_usuario);
        return $respuesta;
    }

    static public function ctrActualizarUsuarios($tabla,$datos){
        $respuesta = usuariosmodel::mdlActualizarUsuarios($tabla,$datos);
        return $respuesta;
    }

    static public function ctrEliminarUsuarios($tabla,$id_usuario){
        $respuesta = usuariosmodel::mdlEliminarUsuarios($tabla,$id_usuario);
        return $respuesta;
    }

    static public function ctrListarUsuariosxSede($tabla,$sede){
        $respuesta = usuariosmodel::mdlListarUsuariosxSede($tabla,$sede);
        return $respuesta;
    }
}
?>