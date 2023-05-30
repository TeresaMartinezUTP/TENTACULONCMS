<?php
require_once "../../controller/postulante_controller.php";
require_once '../../model/postulante_model.php';
require_once '../../extensiones/encriptacion.php';
class Postulanteajax
{
    public function ajaxPostulante()
    {
        if (isset($_POST['area_postular'])) { //Nuevo
            if ($_POST['area_postular'] != null  && $_POST['nombre_postular'] != null && $_POST['tipodoc_postular'] != null  && $_POST['numdoc_postular'] != null && $_POST['numdoc_postular'] != null) {

                $tabla = "postulante";
                $datos = array(
                    "area"      => $_POST['area_postular'],
                    "nombres"   => $_POST['nombre_postular'],
                    "tipo_doc"  => $_POST['tipodoc_postular'],
                    "num_doc"   => $_POST['numdoc_postular'],
                    "telefono"  => $_POST['telefono_postular'],
                    "correo"    => $_POST['correo_postular']
                );
                $respuesta = postulantecontroller::ctrRegistroPostulante($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'guardado'
                    );
                } else if ($respuesta == "repeatcorreo") {
                    $response = array(
                        'responseJson' => 'repeatcorreo'
                    );
                }else if ($respuesta == "repeat") {
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
        } else if (isset($_POST["id_postu"])) { //Ver
            $id_postu = $_POST["id_postu"];
            $tabla = 'postulante';
            $descryt = Encriptacion::decryption($id_postu);
            $response = postulantecontroller::ctrMostrarPostulantexID($tabla, $descryt);
        } else if (isset($_POST["postularE"])) {//Actualizar
            if ($_POST['postularE'] != null && $_POST['area_postularE'] != null && $_POST['nombre_postularE'] != null && $_POST['tipodoc_postularE'] != null && $_POST['numdoc_postularE'] != null) {
                $tabla = 'postulante';
                $datos = array(
                    "area"              => $_POST['area_postularE'],
                    "nombres"           => $_POST['nombre_postularE'],
                    "tipo_doc"          => $_POST['tipodoc_postularE'],
                    "num_doc"           => $_POST['numdoc_postularE'],
                    "telefono"          => $_POST['telefono_postularE'],
                    "correo"            => $_POST['correo_postularE'],
                    "id_postulante"     => $_POST['postularE']
                );
                $respuesta = postulantecontroller::ctrActualizarPostulante($tabla, $datos);
                if ($respuesta == "ok") {
                    $response = array(
                        'responseJson' => 'actualizado'
                    );
                }else if ($respuesta == "repeatcorreo") {
                    $response = array(
                        'responseJson' => 'repeatcorreo'
                    );
                } else if ($respuesta == "repeat") {
                    $response = array(
                        'responseJson' => 'repeat'
                    );
                }else {
                    if ($respuesta == "error") {
                        $response = array(
                            'responseJson' => 'error'
                        );
                    }
                }
            }
        } else if (isset($_POST["id_postElm"])) {
            $id_postu = $_POST["id_postElm"];
            $descryt = Encriptacion::decryption($id_postu);
            $respuesta = postulantecontroller::ctrEliminarTablaPostulante($descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'response' => 'eliminado'
                );
            } else if ($respuesta == "error") {
                $response = array(
                    'response' => 'error'
                );
            }
        } else if (isset($_POST["postulante"])) {
            $tabla = "postulante";
            $estado = $_POST["estado"];
            $descryt = Encriptacion::decryption($_POST["postulante"]);
            $respuesta = postulantecontroller::ctrCambiarEstado($tabla, $estado, $descryt);
            if ($respuesta == "ok") {
                $response = array(
                    'responseJson' => 'true'
                );
            } else if ($respuesta == "error") {
                $response = array(
                    'responseJson' => 'error'
                );
            }
        } else if (isset($_FILES['img_curriculum_vitae'])) {
            if ($_FILES['img_curriculum_vitae'] != null && $_POST['curriculumvitae'] != null) {
                $uploads_dir = '../../views/Curriculum';
                $tmp_name = $_FILES["img_curriculum_vitae"]["tmp_name"];
                $file = $_FILES['img_curriculum_vitae'];
                $filename = $file['name'];
                $mimetype = $file['type'];
                if ($_POST['namedocumentovitae'] == null || $_POST['namedocumentovitae'] == "") {
                    if (
                        $mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'application/msword' || $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $mimetype == 'application/pdf'
                    ) {
                        $imagenCV = $filename;
                        $name = basename($_FILES["img_curriculum_vitae"]["name"]);
                        $tabla = 'postulante';
                        $datos = array(
                            "documento"     => $imagenCV,
                            "id_postulante"   => $_POST['curriculumvitae']
                        );

                        $respuesta = postulantecontroller::ctrAdjuntarArchivo($tabla, $datos);
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
                    } else {
                        $response = array(
                            'responseJson' => 'noImage'
                        );
                    }
                } else {
                    if (
                        //$mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'application/msword' || $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $mimetype == 'application/pdf'
                        $mimetype == 'application/pdf'
                    ) {
                        $imagenCV = $filename;
                        $name = basename($_FILES["img_curriculum_vitae"]["name"]);
                        unlink("../../views/Curriculum/" . $_POST['namedocumentovitae']);
                        $tabla = 'postulante';
                        $datos = array(
                            "documento"     => $imagenCV,
                            "id_postulante"   => $_POST['curriculumvitae']
                        );

                        $respuesta = postulantecontroller::ctrAdjuntarArchivo($tabla, $datos);
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
                    } else {
                        $response = array(
                            'responseJson' => 'noImage'
                        );
                    }
                }
            }
        }else if(isset($_POST['postulantesAprobados'])){
            $tabla='postulante';
            $response = postulantecontroller::ctrListarPostulanteAprobados($tabla);
        } else {
            $response = array(
                'response' => 'error'
            );
        }
        echo json_encode($response);
    }
}
$resp = new Postulanteajax();
$resp->ajaxPostulante();
