<?php


require_once "../helpers/login.php";
require_once "../helpers/sesion.php";

iniciaSesion();

$nombreUsuario=isset( $_GET['nombreUsuario']) ;
//echo "¡Bienvenido, $nombreUsuario!";


if (estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
   //$nombreUsuario = $_SESSION['nombreUsuario']; // Obtén el nombre del usuario desde la sesión
   guardaSesion('nombreUsuario',crearUsuario());
   echo "¡Bienvenido, $nombreUsuario!";


} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";

   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}

// Puedes agregar más contenido y funcionalidad aquí que solo los usuarios logueados puedan ver.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 // Verifica si se presionó el botón "borrar"
 if (isset($_POST["out"])) {

    cierraSesion();

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
