<?php
#Abrir sesion y cerrar, leer sesion, guardar sesion, como metodos

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
      if (isset($_SESSION[$clave])) {
        return $_SESSION[$clave];
      } else {
        return null;
      }
    }


public static function existeSesion($clave) {
      return isset($_SESSION[$clave]);
    }

}


?>