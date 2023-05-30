<?php
require_once '../../controller/login_controller.php';
require_once '../../model/login_model.php';
session_start();
class LoginAjax
{
    public function ajaxLogin()
    {
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            if ($_POST['user'] != null && $_POST['pass'] != null) {
                $user = strtolower($_POST['user']);
                $pass = $_POST['pass'];

                $responseFind = logincontrolador::ctrsignInUser($user, $pass);

                $responseFindAll = [];
                foreach ($responseFind as $row) {
                    if (password_verify($pass, $row['contraseña'])) {
                        $responseFindAll = $row;
                        break;
                    }
                }
                if (count($responseFindAll) == 0) {
                    $response = array(
                        'response' => 'notfound'
                    );
                } else if ($responseFindAll['estado'] != "Activo") {
                    $response = array(
                        'response' => 'desactivado'
                    );
                } else {
                        $response = array(
                            'response' => 'isvalid',
                            'rol' => $responseFindAll['nombre'],
                        );
                        $_SESSION['id_usuario'] = $responseFindAll['id_usuario'];
                        $_SESSION['iniciarSesion'] = 'ok';
                        $_SESSION['nombres'] = $responseFindAll['nombres'];
                        $_SESSION['correo'] = $responseFindAll['correo'];
                        $_SESSION['tipo_trabajador'] = $responseFindAll['nombre'];
                        $_SESSION['id_localemple'] = $responseFindAll['id_localemple'];
                        $_SESSION['id_local'] = $responseFindAll['id_local'];
                        $_SESSION['nombre_sede'] = $responseFindAll['sede'];
                        $_SESSION['id_empleado'] = $responseFindAll['id_empleado'];
                }
            }
        } else {
            $response = array(
                'response' => 'error'
            );
        }
        echo json_encode($response);
    }
}
$resp = new LoginAjax();
$resp->ajaxLogin();
