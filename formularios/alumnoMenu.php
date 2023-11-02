<?php

require_once '../cargador.php';

cargador::autocargar();

sesion::iniciaSesion();

$nombreUsuario = isset($_GET['nombreUsuario']) ? $_GET['nombreUsuario'] : "";



if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
   echo "¡Bienvenido, $nombreUsuario!";


   sesion::guardaSesion('nombreUsuario',funcionesLogin::crearUsuario());


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



?>


<!DOCTYPE html>
<html>
<head>
    <title>Alumno</title>
</head>
<body>
   


    <form id="miFormulario" method="post" action="alumnoMenu.php?nombreUsuario=<?php echo $nombreUsuario; ?>">
    <h1>Registro de Usuario</h1>
    
    <h1>Hacer examenes</h1>

    <h1>Ver resultados</h1>

        
        <input type="submit" value="out" name="out">



    </form>


    </form>
</body>
</html>
