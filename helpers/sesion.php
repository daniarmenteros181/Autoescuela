<?php
#Abrir sesion y cerrar, leer sesion, guardar sesion, como metodos


function iniciaSesion() {

    session_start();


}

function cierraSesion() {

    session_destroy();
    

}

function guardaSesion($clave,$valor) {

    $_SESSION[$clave]=$valor;

}

function leerSesion($clave) {
    

}

function existeSesion($clave) {
    

}

?>