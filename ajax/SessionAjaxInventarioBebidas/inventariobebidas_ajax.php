<?php
require_once '../../controller/inventariobebidas_controller.php';
require_once '../../model/inventariobebidas_model.php';

class inventariobebidaLocalAjax
{
    public function Ajaxbebidalocal()
    {
        if (isset($_POST['listarBebida'])) {
            if ($_POST['listarBebida'] != null && $_POST['stock'] != null) {
                $tabla = "inventario_bebidas";
                $datos = array(
                    "id_localbebida" => $_POST['listarBebida'],                    
                    "stock" => $_POST['stock']
                );
                $respuesta = inventariobebidascontroller::ctrRegistrarInventarioBebida($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'guardado'
                    );
                } 
                else if($respuesta == "repeat"){
                    $response = array(
                        'response' => 'repeat'
                    );

                }else {
                    if ($respuesta == "error") {
                        $response = array(
                            'response' => 'error'
                        );
                    }
                }
            } 
        }else if (isset($_POST["id_mostrar"])) {
            $id_localbebida=$_POST["id_mostrar"];
            $tabla="inventario_bebidas";
            $response = inventariobebidascontroller::ctrMostrarInventarioBebida($tabla,$id_localbebida);
        }else if(isset($_POST['id_blEditar'])){
            if ($_POST['listarBebidaEditar'] != null && $_POST['stockEditar'] != null){
                $tabla="inventario_bebidas";
                $datos = array(
                    "stock" => $_POST['stockEditar'], 
                    "id_localbebida" => $_POST['listarBebidaEditar'],                    
                    "id_inventario" => $_POST['id_blEditar']  
                );
                $respuesta = inventariobebidascontroller::ctrActualizarInventarioBebida($tabla,$datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'response' => 'actualizado'
                    );
                }else if($respuesta == "repeat"){
                    $response = array(
                        'response' => 'repeat'
                    );
                } 
                else {
                    if ($respuesta == "error") {
                        $response = array(
                            'response' => 'error'
                        );
                    }
                }
            }
        }
        else if(isset($_POST["id_eliminar"])){
            $id_localbebida =$_POST["id_eliminar"];
            $tabla="inventario_bebidas";
            $respuesta = inventariobebidascontroller::ctrEliminaBebidaInventario($tabla,$id_localbebida);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'eliminado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'response' => 'error'
                    );
                }
            }
        }else {
            $response = array(
                'response' => 'error'
            );
        }  
        echo json_encode($response);
    }
}
$resp = new inventariobebidaLocalAjax;
$resp->Ajaxbebidalocal();
