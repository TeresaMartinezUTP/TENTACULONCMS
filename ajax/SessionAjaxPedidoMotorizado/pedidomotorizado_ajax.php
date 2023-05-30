<?php
require_once '../../controller/pedidomotorizado_controller.php';
require_once '../../model/pedidomotorizado_model.php';

class pedidomotorizadoajax
{

    public function ajaxpedidomotorizado()
    {

        if (isset($_POST['id_venta'])) {
            if ($_POST['id_venta'] != null) {
                $datos = array(
                    'id_venta'        => $_POST['id_venta']
                );
                $respuesta = pedidomotorizadocontroller::ctrRegistrarPedidoMotorizado($datos);
                if ($respuesta == 'ok') {
                    $response = array(
                        'responseJson' => 'guardado'
                    );
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
        }else if (isset($_POST['pedidomotoxventa'])) {
            $response = pedidomotorizadocontroller::ctrListaPedidoMotorizadoxVenta($_POST['pedidomotoxventa']);
        }else if ( isset($_POST['id_ventaE']) && $_POST['id_localemple'] != null ) {
            $datos = array(
                'id_venta'        => $_POST['id_ventaE'],
                'id_localemple' => $_POST['id_localemple'],
            );
            $respuesta = pedidomotorizadocontroller::ctrActualizarEstadoPedidoMotorizado($datos);
        }
        else if (isset($_POST['id_p_motorizadoR'])) {
            $id_p_motorizado = $_POST['id_p_motorizadoR'];
            $response = pedidomotorizadocontroller::ctrListarPedidoMotorizadoxId($id_p_motorizado);
        } else if (isset($_POST['id_p_motorizado'])) {
            $id_p_motorizado = $_POST['id_p_motorizado'];
            $id_venta = $_POST['id_ventaF'];
            $data = array(
                'estado' => $_POST['estado'],
                'ruta_imagen' => null,
                'finalizar' => false,
                'descripcion' => $_POST['descripcion'],
                'id_incidencia' => $_POST['id_incidencia']
            );
            $respuesta = pedidomotorizadocontroller::ctrActualizarPedidoMotorizado($id_p_motorizado, $data);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'actualizado'
                );
                $respuesta = pedidomotorizadocontroller::ctrFinalizarVenta($id_venta);
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        } else if (isset($_POST['id_p_motorizadoF'])) {

            $id_p_motorizado = $_POST['id_p_motorizadoF'];
            $id_venta = $_POST['id_ventaF'];;

            $data = array(
                'estado' => "Entregado",
                'descripcion' => null,
                'id_incidencia' => null,
                'ruta_imagen'   => "",
                'finalizar'   => true,
            );

            $respuesta = pedidomotorizadocontroller::ctrActualizarPedidoMotorizado($id_p_motorizado, $data);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'actualizado'
                );
                $respuesta = pedidomotorizadocontroller::ctrFinalizarVenta($id_venta);
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        } else if (isset($_POST['token'])) {
            $id_p_motorizado = $_POST['token'];

            $uploads_dir = '../../views/imgmotorizado';
            $tmp_name = $_FILES['ruta_imagen']['tmp_name'];
            $name = basename($_FILES['ruta_imagen']['name']);

            $data = array(
                'estado' => "",
                'descripcion' => null,
                'id_incidencia' => null,
                'ruta_imagen'   => $name,
            );

            $respuesta = pedidomotorizadocontroller::ctrActualizarPedidoMotorizado($id_p_motorizado, $data);
            if ($respuesta == "ok") {
                try {
                    unlink("../../views/imgmotorizado/".$_POST['antiguo']);
                } catch (\Throwable $th) {
                }
                $response = array(
                    'responseJson' => 'adjuntado'
                );
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
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
$resp = new pedidomotorizadoajax();
$resp->ajaxpedidomotorizado();
