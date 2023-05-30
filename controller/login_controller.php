<?php
class logincontrolador
{
    static public function ctrsignInUser($user,$pass){
        $respuesta = loginmodelo::mdlsignInUser($user,$pass);
        return $respuesta;
    }

}