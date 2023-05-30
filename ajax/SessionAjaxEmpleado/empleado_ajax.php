<?php
require_once "../../controller/empleado_controller.php";
require_once '../../model/empleado_model.php';
require_once '../../controller/postulante_controller.php';
require_once '../../model/postulante_model.php';
require_once '../../extensiones/encriptacion.php';
class empleadosajax
{
    public function ajaxEmpleado()
    {
        if (isset($_POST['nombre_empleado'])) {
            if ($_POST['nombre_empleado'] != null && $_POST['tipo_doc'] != null && $_POST['numero_doc'] != null  && $_POST['correo'] != null && $_POST['tipo_area'] != null) {

                $tabla = "empleado";
                $datos = array(
                    "nombres"       => $_POST['nombre_empleado'],
                    "tipo_doc"      => $_POST['tipo_doc'],
                    "num_doc"       => $_POST['numero_doc'],
                    "telefono"      => $_POST['telefono'],
                    "correo"        => $_POST['correo'],
                    "area"          => $_POST['tipo_area']
                );
                $respuesta = empleadoscontroller::ctrRegistroEmpleados($tabla, $datos);
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
            }
        } else if (isset($_POST["id_empleado"])) {
            $id_empleado = $_POST["id_empleado"];
            $descryt = Encriptacion::decryption($id_empleado);
            $response = empleadoscontroller::ctrBuscarEmpleadosxID($descryt);
        } else if (isset($_POST['empleadoE'])) {
            if ($_POST['empleadoE'] != null && $_POST['nombre_empleadoE'] != null && $_POST['tipo_docE'] != null && $_POST['numero_docE'] != null && $_POST['tipo_areaE'] != null && $_POST['correoE'] != null) {

                $tabla = 'empleado';
                $datos = array(
                    "nombres"       => $_POST['nombre_empleadoE'],
                    "tipo_doc"      => $_POST['tipo_docE'],
                    "num_doc"       => $_POST['numero_docE'],
                    "telefono"      => $_POST['telefonoE'],
                    "correo"        => $_POST['correoE'],
                    "area"          => $_POST['tipo_areaE'],
                    "id_empleado"   => $_POST['empleadoE']
                );
                $respuesta = empleadoscontroller::ctrActualizarEmpleados($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'actualizado'
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
            }
        } else if (isset($_FILES['img_canet_sanidad'])) {
            if ($_FILES['img_canet_sanidad'] != null && $_POST['carnedsanidad'] != null) {
                $uploads_dir = '../../views/DocumentoSalud';
                $tmp_name = $_FILES["img_canet_sanidad"]["tmp_name"];
                $file = $_FILES['img_canet_sanidad'];
                $filename = $file['name'];
                $mimetype = $file['type'];
                $ni="";
                if ($_POST['namedocumento'] == null || $_POST['namedocumento'] == "") {
                    if (
                        $mimetype == 'application/pdf'
                        //$mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'
                    ) {
                        $imagenCS = $filename;
                        $name = basename($_FILES["img_canet_sanidad"]["name"]);
                    }else{
                        $ni="noImage";
                    }
                } else {
                    if (
                        $mimetype == 'application/pdf'
                        //$mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'
                    ) {
                        $imagenCS = $filename;
                        $name = basename($_FILES["img_canet_sanidad"]["name"]);
                        unlink("../../views/DocumentoSalud/" . $_POST['namedocumento']);
                    }else{
                        $ni="noImage";
                    }
                }
                
                if ($ni!="noImage") {
                    $tabla = 'empleado';
                    $datos = array(
                        "documento"     => $imagenCS,
                        "id_empleado"   => $_POST['carnedsanidad']
                    );
                    $respuesta = empleadoscontroller::ctrAdjuntarArchivo($tabla, $datos);
                if ($respuesta == "ok") {
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
                }else{
                    $response = array(
                        'responseJson' => 'noImage'
                    );
                }
            }
        } else if (isset($_POST["id_empleadoElm"])) {
            $id_empleado = $_POST["id_empleadoElm"];
            $descryt = Encriptacion::decryption($id_empleado);
            $respuesta = empleadoscontroller::ctrEliminarTablaEmpleados($descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'eliminado'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                    
                }else if ($respuesta == "tienele") {
                    $response = array(
                        'responseJson' => 'tienele'
                    );
                    
                }
            }
        } else if (isset($_POST['id_estado'])) {
            $descryt = Encriptacion::decryption($_POST['id_estado']);
            $tabla = 'empleado';
            $estado = $_POST['estado'];
            $respuesta = empleadoscontroller::ctrCambiarEstado($tabla, $estado, $descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'true'
                );
            } else {
                if ($respuesta == "error") {
                    $response = array(
                        'responseJson' => 'error'
                    );
                }
            }
        } else if (isset($_POST['id_empleadoEmail'])) {
            $tabla = 'empleado';
            $response = empleadoscontroller::ctrMostrarcorreoEmpleados($tabla, $_POST['id_empleadoEmail']);
        } else if (isset($_POST['name_postulanteAct'])) {
            if ($_POST['name_postulanteAct'] != null && $_POST['tipo_docPostulante'] != null && $_POST['numero_docPostulante'] != null  && $_POST['correoPostulante'] != null && $_POST['tipo_areaPostulante'] != null) {
                if ($_POST['telefonoPostulante'] == "") {
                    $telefono = "sin registro";
                } else {
                    $telefono = $_POST['telefonoPostulante'];
                }

                $tabla = "empleado";
                $datos = array(
                    "nombres"       => $_POST['name_postulanteAct'],
                    "tipo_doc"      => $_POST['tipo_docPostulante'],
                    "num_doc"       => $_POST['numero_docPostulante'],
                    "telefono"      => $telefono,
                    "correo"        => $_POST['correoPostulante'],
                    "area"          => $_POST['tipo_areaPostulante']
                );
                $respuesta = empleadoscontroller::ctrRegistroEmpleados($tabla, $datos);
                $status = 1;
                $tablap = 'postulante';
                postulantecontroller::ctrActualizarStatus($tablap,$status,$_POST['name_postulanteAct']);
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
            }
        } else {
            $response = array('responseJson' => 'error');
        }

        echo json_encode($response);
    }
}
$resp = new empleadosajax();
$resp->ajaxEmpleado();
