<?php
require_once "../../controller/plato_controller.php";
require_once '../../model/plato_model.php';
require_once '../../extensiones/encriptacion.php';

class platosajax
{
    public function ajaxplatos()
    {
        if (isset($_POST['nombreplato'])) {
            if ($_POST['nombreplato'] != null && $_POST['item_categoriaplato'] != null  && $_POST['descripcionplato'] != null && $_POST['precioplato'] != null && $_FILES["imagen"]["tmp_name"] != null) {
                $uploads_dir = '../../views/imgplato';
                $tmp_name = $_FILES["imagen"]["tmp_name"];
                $name = basename($_FILES["imagen"]["name"]);

                $tabla = 'platos';
                $data = array(
                    "nombre_plato"  => $_POST['nombreplato'],
                    "descripcion"   => $_POST['descripcionplato'],
                    "precio"        => $_POST['precioplato'],
                    "id_categoria"  => $_POST['item_categoriaplato'],
                    "imagen"        => $name
                );

                $respuesta = platoscontroller::ctrRegistrarPlato($tabla, $data);

                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'guardado'
                    );
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
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
                    'responseJson' => 'vacio'
                );
            }
        } else if (isset($_POST['plato'])) {
            $descryt = Encriptacion::decryption($_POST['plato']);
            $tabla = 'platos';
            $response = platoscontroller::ctrMostrarPlato($tabla, $descryt);
        } else if (isset($_POST['platoEditar'])) {
            if ($_POST['platoEditar'] != null && $_POST['nombreplatoEdit'] != null && $_POST['descripcionplatoEdit'] != null && $_POST['precioplatoEdit'] != null && $_POST['item_cateEdit'] != null && $_POST['statusplato'] != null) {
                $tabla = 'platos';
                $uploads_dir = '../../views/imgplato';
                $tmp_name = $_FILES["imgPlatoUdp"]["tmp_name"];
                if ($tmp_name == "") {
                    $name = $_POST['updt-imagePlato'];
                } else {
                    $name = basename($_FILES["imgPlatoUdp"]["name"]);
                    unlink("../../views/imgplato/".$_POST['updt-imagePlato']);
                }
                $data = array(
                    "nombre_plato"  => $_POST['nombreplatoEdit'],
                    "descripcion"   => $_POST['descripcionplatoEdit'],
                    "precio"        => $_POST['precioplatoEdit'],
                    "id_categoria"  => $_POST['item_cateEdit'],
                    "id_plato"      => $_POST['platoEditar'],
                    "status"        => $_POST['statusplato'],
                    "imagen"        => $name
                );

                $respuesta = platoscontroller::ctrActualizarPlato($tabla, $data);

                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'actualizado'
                    );
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                } else {
                    if ($respuesta == "error") {
                        $response = array(
                            'responseJson' => 'error'
                        );
                    }
                }
            } else {
                $response = array(
                    'responseJson' => 'vacio'
                );
            }
        } else if (isset($_POST['Eliminar'])) {
            $tabla = 'platos';
            $descryt = Encriptacion::decryption($_POST['Eliminar']);
            $imagen = $_POST['imagenElm'];
            
            $respuesta = platoscontroller::ctrEliminarPlato($tabla, $descryt);            
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
                if ($imagen != "default.jpg") {
                    unlink("../../views/imgplato/$imagen");
                }
            }else if ($respuesta == 'usado') {
                $response = array(
                    'responseJson' => 'usado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        }else{
            $response = array(
                'responseJson' => 'error'
            );
        }

        echo json_encode($response);
    }
}

$resp = new platosajax();
$resp->ajaxplatos();
