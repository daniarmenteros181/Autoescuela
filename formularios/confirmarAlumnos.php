<?php
/*
require_once '../cargador.php';
cargador::autocargar();

class confirmarAlumnos{

public static function llamada(){

sesion::iniciaSesion();

$nombreUsuario = isset($_GET['nombreUsuario']) ? $_GET['nombreUsuario'] : "";



if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
   echo "¡Bienvenido, $nombreUsuario!";


   //sesion::guardaSesion('nombreUsuario',funcionesLogin::crearUsuario());
   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);

    // Conectar a la base de datos utilizando la clase db
    $conexion = db::entrar();

    // Realizar una consulta para seleccionar los usuarios sin rol asignado
    $stmt = $conexion->query("SELECT * FROM usuario WHERE rol = '' ");

    // Procesar los resultados y mostrar la lista de usuarios
    echo "<h2>Usuarios sin rol asignado:</h2>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . $row['nombre'] . "</li>";
    }
    echo "</ul>";


} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";

   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}

// Puedes agregar más contenido y funcionalidad aquí que solo los usuarios logueados puedan ver.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // Verifica si se presionó el botón "borrar"
 if (isset($_POST["asignarRol"])) {


    

    
 
}

 // Verifica si se presionó el botón "borrar"
 if (isset($_POST["out"])) {
    
    sesion::cierraSesion();

    header('Location: http://autoescueladaniels.com/formularios/login.php?');
    
 
}
}

}



}

confirmarAlumnos::llamada();
*/


class ConfirmarAlumnos {


    
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function mostrarUsuariosSinRol() {
/*         $this->iniciarSesion();
 */
        if ($this->estarLogeado()) {
           // echo "¡Bienvenido, $nombreUsuario!";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verifica si se ha enviado el formulario para asignar un rol
                if (isset($_POST["asignarRol"]) && isset($_POST["usuarioId"]) && isset($_POST["nuevoRol"])) {
                    $usuarioId = $_POST["usuarioId"];
                    $nuevoRol = $_POST["nuevoRol"];

                    // Actualiza el rol del usuario en la base de datos
                    $this->asignarRolAUsuario($usuarioId, $nuevoRol);
                }
            }

            // Realizar una consulta para seleccionar los usuarios sin rol asignado
            $stmt = $this->conexion->query("SELECT * FROM usuario WHERE rol = '' ");

            echo "<h2>Usuarios sin rol asignado:</h2>";
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . $row['nombre'] . " <form method='post'>
                    <input type='hidden' name='usuarioId' value='{$row['id']}'>
                    <select name='nuevoRol'>
                        <option value='admin'>Admin</option>
                        <option value='profesor'>Profesor</option>
                        <option value='alumno'>Alumno</option>
                    </select>
                    <input type='submit' name='asignarRol' value='Asignar Rol'>
                </form></li>";
            }
            echo "</ul>";
        } else {
            echo "mal, usuario!";
            header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["out"])) {
            $this->cierraSesion();
            header('Location: http://autoescueladaniels.com/formularios/login.php?');
        }
    }

    /* private function iniciarSesion() {
        sesion::iniciaSesion();
    } */

    private function estarLogeado() {
        return funcionesLogin::estarLogeado();
    }

    private function cierraSesion() {
        sesion::cierraSesion();
    }

    private function asignarRolAUsuario($usuarioId, $nuevoRol) {
        $sql = "UPDATE usuario SET rol = :nuevoRol WHERE id = :usuarioId";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':usuarioId', $usuarioId);
        $stmt->bindParam(':nuevoRol', $nuevoRol);
        $stmt->execute();
    }
}

$conexion = db::entrar();
$confirmarAlumnos = new ConfirmarAlumnos($conexion);
$confirmarAlumnos->mostrarUsuariosSinRol();
 


?>


<!DOCTYPE html>
<html>
<head>
    <title>Verificar</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilosMenu.css">

</head>
<body>
   
    <form id="miFormulario" method="post" action="confirmarAlumnos.php?nombreUsuario=">

    <select name='nuevoRol'>
        <option value='admin'>Admin</option>
        <option value='profesor'>Profesor</option>
        <option value='alumno'>Alumno</option>
    </select>
        <input type='submit' name='asignarRol' value='Asignar Rol'>

        
    
    <input type="submit" value="out" name="out">

    </form>


</body>
</html>
