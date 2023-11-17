<?php

class adminMenu{

public static function llamada(){

    mostrarMenu::mostrarMenuAdmin();

$nombreUsuario = sesion::leerSesion('nombreUsuario');



if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
    sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);



} else {
   // El usuario no está logueado, redirige a la página de inicio de recuperar contraseña.
   header('Location: ?menu=olvido');

}

//Si se presiona el boton de out, cierra la sesion y te lleva al inicio
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 // Verifica si se presionó el botón "borrar"
 if (isset($_POST["out"])) {
    
    sesion::cierraSesion();
    header('Location: ?menu=login');
    
 
}
}

}


}

adminMenu::llamada();

