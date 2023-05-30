<?php
require_once "../../controller/categoriaplatos_controller.php";
require_once '../../model/categoriaplatos_model.php';
require_once '../../extensiones/encriptacion.php';

class categoriaplatosajax
{
    public function ajaxcategoriplatos()
    {
        if (isset($_POST['nombre_cate'])) {
            if ($_POST['nombre_cate'] != null && $_FILES["imagen"]["tmp_name"] != null) {
                $uploads_dir = '../../views/imgcateplato';
                $tmp_name = $_FILES["imagen"]["tmp_name"];
                $name = basename($_FILES["imagen"]["name"]);

                if ($_POST['descripcion_cate'] == "") {
                    $descripcion = "Sin Registro";
                } else {
                    $descripcion = $_POST['descripcion_cate'];
                }
                $tabla = "categoria_platos";
                $datos = array(
                    "nombre"        => $_POST['nombre_cate'],
                    "descripcion"   => $descripcion,
                    "imagen"        => $name,
                );

                $respuesta = categoriaplatoscontroller::ctrRegistrarCategoriaPlato($tabla, $datos);
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
        } else if (isset($_POST['id_categoriaP'])) {
            $descryt = Encriptacion::decryption($_POST['id_categoriaP']);
            $tabla = 'categoria_platos';
            $response = categoriaplatoscontroller::ctrMostrarCategoriaPlato($tabla, $descryt);
        } else if (isset($_POST['cateplatoEditar'])) {
            if ($_POST['cateplatoEditar'] != null && $_POST['nombrecateEditar'] != null && $_POST['statuscategoria'] != null) {
                $tabla = 'categoria_platos';
                $uploads_dir = '../../views/imgcateplato';
                $tmp_name = $_FILES["imgCategoriaPlato"]["tmp_name"];
                if ($tmp_name == "") {
                    $name = $_POST['updt-image'];
                } else {
                    $name = basename($_FILES["imgCategoriaPlato"]["name"]);
                }

                $datos = array(
                    "nombre"        => $_POST['nombrecateEditar'],
                    "descripcion"   => $_POST['descripcion_cateEdit'],
                    "imagen"        => $name,
                    "id_categoria"  => $_POST['cateplatoEditar'],
                    "status"        => $_POST['statuscategoria']
                );

                $respuesta = categoriaplatoscontroller::ctrActualizarCategoriaPlato($tabla, $datos);
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
        } else if (isset($_POST['idCategoriaPlato'])) {
            $descryt = Encriptacion::decryption($_POST['idCategoriaPlato']);
            $imagen = $_POST['imagenElm'];
            $tabla = 'categoria_platos';

            $respuesta = categoriaplatoscontroller::ctrEliminarCategoriaPlato($tabla, $descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
                if ($imagen != "default.jpg") {
                    unlink("../../views/imgcateplato/$imagen");
                }
            } else if ($respuesta == 'usado') {
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
        } else {
            $response = array(
                'responseJson' => 'error'
            );
        }
        echo json_encode($response);
    }
}

$resp = new categoriaplatosajax();
$resp->ajaxcategoriplatos();