<?php

require_once '../cargador.php';
cargador::autocargar();

class verNotas{

public static function llamada(){

sesion::iniciaSesion();

$nombreUsuario = isset($_GET['nombreUsuario']) ? $_GET['nombreUsuario'] : "";



if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
   echo "¡Bienvenido, $nombreUsuario!";


   sesion::guardaSesion('nombreUsuario',funcionesLogin::crearUsuario());
   //sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);



} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";

   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}

// Puedes agregar más contenido y funcionalidad aquí que solo los usuarios logueados puedan ver.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 // Verifica si se presionó el botón "borrar"
 if (isset($_POST["out"])) {
    
    sesion::cierraSesion();

    header('Location: http://autoescueladaniels.com/formularios/login.php?');
    
 
}
}

}

}

verNotas::llamada();



?>


<!DOCTYPE html>
<html>
<head>
    <title>Ver Notas</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilosMenu.css">

</head>
<body>
   
    <form id="miFormulario" method="post" action="verNotas.php?nombreUsuario=">
        
    
    <input type="submit" value="out" name="out">

    </form>


</body>
</html>