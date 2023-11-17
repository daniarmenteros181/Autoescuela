<?php

class ConfirmarAlumnos {


public static function llamada(){

    mostrarMenu::mostrarMenuAdmin();

    $nombreUsuario = sesion::leerSesion('nombreUsuario');


    if (funcionesLogin::estarLogeado()) {
        // El usuario está logueado, muestra el contenido protegido aquí.
        sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);
    
    
    
    } else {
        // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
        echo "mal, usuario!";
    
       header('Location: ?menu=olvido');
       exit();
    
    }
    
    // Muestra la lista de usuarios sin rol asignado


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica si se ha enviado el formulario para asignar un rol
        if (isset($_POST["asignarRol"]) && isset($_POST["usuarioId"]) && isset($_POST["nuevoRol"])) {
            $usuarioId = $_POST["usuarioId"];
            $nuevoRol = $_POST["nuevoRol"];

            // Actualiza el rol del usuario en la base de datos
            self::asignarRolAUsuario($usuarioId, $nuevoRol);
        }
        // Verifica si se presionó el botón "borrar"
        if (isset($_POST["out"])) {
            
            sesion::cierraSesion();

            header('Location: ?menu=login');
            
        
        }
    }


}
    
    

    public static  function mostrarUsuariosSinRol() {

        try {
            $conexion = db::entrar();
    
            // Realizar una consulta para seleccionar los usuarios sin rol asignado
            $stmt = $conexion->query("SELECT * FROM usuario WHERE rol = '' ");

            echo "<h2>Usuarios sin rol asignado:</h2>";
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li id='lista'>" . $row['nombre'] . " <form method='post'>
                    <input type='hidden' name='usuarioId' value='{$row['id']}'>
                    <select name='nuevoRol'>
                        <option value='admin'>Admin</option>
                        <option value='profesor'>Profesor</option>
                        <option value='alumno'>Alumno</option>
                    </select>
                    <input type='submit' id='asig' name='asignarRol' value='Asignar Rol'>
                </form></li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

        }


    }

    
    
    public static function asignarRolAUsuario($usuarioId, $nuevoRol) {
        try {
            $conexion = db::entrar();
            $sql = "UPDATE usuario SET rol = :nuevoRol WHERE id = :usuarioId";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->bindParam(':nuevoRol', $nuevoRol);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
 
}
confirmarAlumnos::llamada();
confirmarAlumnos::mostrarUsuariosSinRol();




?>


<!DOCTYPE html>
<html>
<head>
    <title>Verificar</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilosConfir.css">

</head>
<body>
   
    <form id="miFormulario" method="post" action="confirmarAlumnos.php?nombreUsuario=">
    </form>


</body>
</html>
