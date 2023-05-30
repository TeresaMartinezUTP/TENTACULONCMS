<?php

require_once '../../controller/clientefre_controller.php';
require_once '../../model/clientefre_model.php';
session_start();
class ClienFrecuenteAjax
{
    public function AjaxClienteFrecuente()
    {
        if (isset($_POST['nombre_clifre'])) {
            if ($_POST['telefono_clifre'] != null && $_POST['email_clifre'] != null) {
                $tabla = "clientes_frecuentes";
                if ($_SESSION['tipo_trabajador'] == "Administrador General") {
                    $datos = array(
                        "nombre_completo" => $_POST['nombre_clifre'],
                        "telefono" => $_POST['telefono_clifre'],
                        "correo" => $_POST['email_clifre'],
                        "descuento" => $_POST['descuento'],
                        "id_local" => $_POST['local_clifre'],
                    );
                } else {
                    if ($_SESSION['tipo_trabajador'] == "Administrador") {
                        $datos = array(
                            "nombre_completo" => $_POST['nombre_clifre'],
                            "telefono" => $_POST['telefono_clifre'],
                            "correo" => $_POST['email_clifre'],
                            "descuento" => $_POST['descuento'],
                            "id_local" => $_SESSION['id_local'],
                        );
                    }
                }
                $respuesta = clientefreControlador::ctrRegistrarClienFrecuente($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'guardado'
                    );
                } else {
                    if ($respuesta == "repeat") {
                        $response = array(
                            'response' => 'repeat'
                        );
                    }
                }
            }
        } else if (isset($_POST["id_cliente_frecuenteA"])) {
            $tabla = "clientes_frecuentes";
            $id_cliente_frecuente = $_POST["id_cliente_frecuenteA"];
            $response = clientefreControlador::ctrMostrarClienFrecuenteID($tabla, $id_cliente_frecuente);
        } else if (isset($_POST['id_cliente_frecuenteEdit'])) {
            if ($_POST['nombreEdit'] != null && $_POST['telefonoEdit'] != null && $_POST['emailEdit'] != null) {
                $tabla = "clientes_frecuentes";

                if ($_SESSION['tipo_trabajador'] == "Administrador General") {
                    $datos = array(
                        "nombre_completo" => $_POST['nombreEdit'],
                        "telefono" => $_POST['telefonoEdit'],
                        "correo" => $_POST['emailEdit'],
                        "descuento" => $_POST['descuentoEdit'],
                        "id_local" => $_POST['local_clifreEdit'],
                        "estado" => $_POST['estadoEdit'],
                        "id_cliente_frecuente" => $_POST['id_cliente_frecuenteEdit']
                    );
                } else {
                    if ($_SESSION['tipo_trabajador'] == "Administrador") {
                        $datos = array(
                            "nombre_completo" => $_POST['nombreEdit'],
                            "telefono" => $_POST['telefonoEdit'],
                            "correo" => $_POST['emailEdit'],
                            "descuento" => $_POST['descuentoEdit'],
                            "id_local" => $_SESSION['id_local'],
                            "estado" => $_POST['estadoEdit'],
                            "id_cliente_frecuente" => $_POST['id_cliente_frecuenteEdit']
                        );
                    }
                }
                
                $respuesta = clientefreControlador::ctrActualizarClienFrecuente($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'actualizado'
                    );
                } else if($respuesta == "repeat"){
                    $response = array(
                        'response' => 'repeat'
                    );
                }else {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        } else if (isset($_POST["id_ClienteFrecuEli"])) {
            $tabla = "clientes_frecuentes";
            $id_cliente_frecuente = $_POST["id_ClienteFrecuEli"];
            $respuesta = clientefreControlador::ctrEliminarTablaClienFrecuente($tabla, $id_cliente_frecuente);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'eliminado'
                );
            } else {
                $response = array(
                    'response' => 'error'
                );
            }
        } else {
            $response = array(
                'response' => 'error'
            );
        }

        echo json_encode($response);
    }
}
$resp = new ClienFrecuenteAjax();
$resp->AjaxClienteFrecuente();
