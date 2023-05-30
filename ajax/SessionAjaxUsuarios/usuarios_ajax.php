<?php
require_once "../../controller/usuarios_controller.php";
require_once '../../model/usuarios_model.php';
require_once '../../extensiones/encriptacion.php';

class usuariosajax
{
    public function ajaxusuarios()
    {
        if (isset($_POST['rol'])) {
            if ($_POST['empleado'] != null && $_POST['rol'] != null && $_POST['sede'] != null && $_POST['contraseña'] != null) {
                $tabla = 'usuarios';
                $datos = array(
                    "id_empleado"       => $_POST['empleado'],
                    "id_localemple"     => $_POST['sede'],
                    "rol"               => $_POST['rol'],
                    "contraseña" => password_hash($_POST['contraseña'], PASSWORD_DEFAULT, array("cost" => 12))
                );

                $respuesta = usuarioscontroller::ctrRegistrarUsuarios($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'guardado'
                    );
                } else if ($respuesta == "repeat") {
                    $response = array(
                        'responseJson' => 'repeat'
                    );
                } else {
                    if ($respuesta == "error") {
                        $response = array(
                            'responseJson' => 'error'
                        );
                    }
                }
            } else {
                $response = array(
                    'responseJson' => 'vacios'
                );
            }
        } else if (isset($_POST['id_usuario'])) {
            $descryt = Encriptacion::decryption($_POST['id_usuario']);
            $tabla = 'usuarios';
            $response = usuarioscontroller::ctrMostrarUsuarios($tabla, $descryt);
        } else if (isset($_POST['Usuarios'])) {
            if ($_POST['Udpempleado'] != null && $_POST['UdpcorreoUsuario'] != null && $_POST['Udprol'] != null && $_POST['Udpsede'] != null) {
                $tabla = 'usuarios';
             
                    $datos = array(
                        "id_empleado"   => $_POST['Udpempleado'],
                        "id_localemple" => $_POST['Udpsede'],
                        "rol"           => $_POST['Udprol'],
                        "contraseña" => password_hash($_POST['Udpcontraseña'], PASSWORD_DEFAULT, array("cost" => 12)),
                        "id_usuario"    => $_POST['Usuarios']
                    );
                

                $respuesta = usuarioscontroller::ctrActualizarUsuarios($tabla,$datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'actualizado'
                    );
                } else {
                    if ($respuesta == "error") {
                        $response = array(
                            'responseJson' => 'error'
                        );
                    }
                }
            }else {
                $response = array(
                    'responseJson' => 'vacios'
                );
            }
        }else if(isset($_POST['id_usuElm'])){
            $descryt = Encriptacion::decryption($_POST['id_usuElm']);
            $tabla = 'usuarios';
            $respuesta = usuarioscontroller::ctrEliminarUsuarios($tabla, $descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        }else {
            $response = array(
                'responseJson' => 'error'
            );
        }

        echo json_encode($response);
    }
}

$resp = new usuariosajax();
$resp->ajaxusuarios();
