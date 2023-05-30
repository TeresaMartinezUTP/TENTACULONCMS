<?php
require_once '../../controller/bebida_controller.php';
require_once '../../model/bebida_model.php';
require_once '../../extensiones/encriptacion.php';

class bebidasajax
{
    public function ajaxbebidas()
    {
        if (isset($_POST['marca'])) {
            if ($_POST['marca'] != null && $_POST['precio'] != null && $_POST['descripcion'] != null) {
                $uploads_dir = '../../views/imgbebida';
                $tmp_name = $_FILES['imagen']['tmp_name'];
                $name = basename($_FILES['imagen']['name']);
                $tabla = 'bebidas';
                $datos = array(
                    'marca'         => $_POST['marca'],
                    'precio'        => $_POST['precio'],
                    'descripcion'   => $_POST['descripcion'],
                    'ruta_imagen'   => $name,
                );
                $respuesta = bebidascontroller::ctrRegistrarBebida($tabla, $datos);
                if ($respuesta == 'ok') {
                    $response = array(
                        'responseJson' => 'guardado'
                    );
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                } else if ($respuesta == 'repeat') {
                    $response = array(
                        'responseJson' => 'repeat'
                    );
                } else {
                    if ($respuesta == 'error') {
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
        } else if (isset($_POST["id_bebida"])) {
            $id_bebida = $_POST["id_bebida"];
            $tabla = "bebidas";
            $response = bebidascontroller::ctrMostrarBebida($tabla, $id_bebida);
        } else if (isset($_POST['id_bebidaED'])) {
            if ($_POST['marcaED'] != null && $_POST['descripcionED'] != null && $_POST['preciobebidaED'] != null) {
                $tabla = "bebidas";
                $uploads_dir = '../../views/imgbebida';
                $tmp_name = $_FILES["imgBebidaUdp"]["tmp_name"];
                if ($tmp_name == "") {
                    $name = $_POST['updt-imageBebida'];
                } else {
                    $name = basename($_FILES["imgBebidaUdp"]["name"]);
                    unlink("../../views/imgbebida/".$_POST['updt-imageBebida']);
                }
                $datos = array(
                    "marca"         => $_POST['marcaED'],
                    "precio"        => $_POST['preciobebidaED'],
                    "descripcion"   => $_POST['descripcionED'],
                    "ruta_imagen"   => $name,
                    "status"        => $_POST['statusED'],
                    "id_bebida"     => $_POST['id_bebidaED']
                );
                $respuesta = bebidascontroller::ctrActualizarBebida($tabla, $datos);
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
        } else if (isset($_POST["idBebida"])) {
            $id_bebida = $_POST["idBebida"];
            $imagen = $_POST["imagen"];
            $tabla = "bebidas";

            $respuesta = bebidascontroller::ctrEliminaBebida($tabla, $id_bebida);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
                if ($imagen != "default.jpg") {
                    unlink("../../views/imgbebida/$imagen");
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
        }
        echo json_encode($response);
    }
}
$resp = new bebidasajax();
$resp->ajaxbebidas();
