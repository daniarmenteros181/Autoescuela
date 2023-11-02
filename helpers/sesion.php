<?php
#Abrir sesion y cerrar, leer sesion, guardar sesion, como metodos

require_once '../cargador.php';
cargador::autocargar();

class sesion{
      
      public static function iniciaSesion() {

    session_start();


}

      public static function cierraSesion() {

    session_destroy();
    

}

      public static function guardaSesion($clave,$valor) {

    $_SESSION[$clave]=$valor;

}

      public static function leerSesion($clave) {
    

}

      public static function existeSesion($clave) {
    

}


}


?>