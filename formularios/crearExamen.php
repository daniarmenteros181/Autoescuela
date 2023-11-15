<?php


class crearExamen{

public static function llamada(){

    mostrarMenu::mostrarMenuAdmin();



$nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
/*    echo "¡Bienvenido, $nombreUsuario!";
 */   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);

} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";
   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}

}


}

crearExamen::llamada();



?>


<!DOCTYPE html>
<html>
<head>
    <title>Crear Exmamen</title>
      <link rel="stylesheet" type="text/css" href="../estilos/estilosPreguntas.css">
 
     
</head>
<body>
    
<div class="pregunta-container">


 <form id="crearPreguntaForm" action="" method="post">

        <label for="enunciado">Enunciado:</label>
        <textarea id="enunciado" name="enunciado" required></textarea><br>

        <label for="respuesta1">Respuesta 1:</label>
        <input type="text" id="respuesta1" name="respuesta1" required><br>

        <label for="respuesta2">Respuesta 2:</label>
        <input type="text" id="respuesta2" name="respuesta2" required><br>

        <label for="respuesta3">Respuesta 3:</label>
        <input type="text" id="respuesta3" name="respuesta3" required><br>


        
    
    <input type="submit" value="out" name="out">

    </form>
    </div>


</body>
</html>
