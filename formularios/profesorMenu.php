<?php

class profesorMenu{

public static function llamada(){

    mostrarMenu::mostrarMenuProfesor();
    $nombreUsuario=sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {

   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);



} else {
    header('Location: ?menu=login');

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 // Verifica si se presionó el botón "borrar"
 if (isset($_POST["out"])) {
    
    sesion::cierraSesion();

    header('Location: ?menu=login');
    
 
}
}

}

}

profesorMenu::llamada();
?>

