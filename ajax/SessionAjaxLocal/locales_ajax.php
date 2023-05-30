<?php 
require_once '../../controller/local_controller.php';
require_once '../../model/local_model.php';
require_once '../../extensiones/encriptacion.php';
class localajax{
    public function ajaxlocal(){        
        if(isset($_POST['codSede'])){
            if($_POST['codSede']!=null && $_POST['direccionlocal']!=null){
                $tabla='local';
                $data = array(
                    'sede'=>$_POST['codSede'],
                    'direccion'=> $_POST['direccionlocal']
                );
                $respuesta = localcontroller::ctrRegistrarLocal($tabla,$data);
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
            }else{
                $response = array(
                    'responseJson' => 'vacios'
                );
            }
        }else if(isset($_POST['id_local'])){
            $descryt = Encriptacion::decryption($_POST['id_local']);
            $tabla = 'local';
            $response = localcontroller::ctrMostrarLocales($tabla, $descryt);
        }else if(isset($_POST['id_localEditar'])){
            if($_POST['UdpcodSede']!=null && $_POST['Udpdireccionlocal']!=null){
                $tabla='local';
                $data = array(
                    'sede'=>$_POST['UdpcodSede'],
                    'direccion'=> $_POST['Udpdireccionlocal'],
                    'status'=> $_POST['statuslocal'],
                    'id_local'=>$_POST['id_localEditar']
                );
                $respuesta = localcontroller::ctrActualizarLocales($tabla,$data);
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
            }else{
                $response = array(
                    'responseJson' => 'vacios'
                );
            }
        }else if(isset($_POST['id_eliminar'])){
            $descryt = Encriptacion::decryption($_POST['id_eliminar']);
            $tabla='Local';
            $respuesta = localcontroller::ctrEliminarLocales($tabla,$descryt);
            if($respuesta == 'ok'){
                $response = array(
                    'responseJson' => 'eliminado'
                );
            }else if($respuesta=='usadoUser'){
                $response = array(
                    'responseJson' => 'usadoUser'
                );
            }else if($respuesta=='usadoLm'){
                $response = array(
                    'responseJson' => 'usadoLm'
                );
            }else if($respuesta=='usadoLp'){
                $response = array(
                    'responseJson' => 'usadoLp'
                );
            }else if($respuesta=='usadoLb'){
                $response = array(
                    'responseJson' => 'usadoLb'
                );
            }else if($respuesta=='usadoLe'){
                $response = array(
                    'responseJson' => 'usadoLe'
                );
            }else if($respuesta=='usadoCf'){
                $response = array(
                    'responseJson' => 'usadoCf'
                );
            }else{
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

$resp=new localajax();
$resp-> ajaxlocal();
