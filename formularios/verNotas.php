<?php


class verNotas{

public static function llamada(){


$nombreUsuario = sesion::leerSesion('nombreUsuario');




if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
   echo "¡Bienvenido, $nombreUsuario!";


   //sesion::guardaSesion('nombreUsuario',funcionesLogin::crearUsuario());
   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);



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

    header('Location: ?menu=login');
    
 
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
   
    <form id="miFormulario" method="post" action="">
        
    
    <input type="submit" value="out" name="out">

    </form>


</body>
</html>
