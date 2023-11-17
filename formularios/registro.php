<?php

class registro{

    public static function creacion(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            if (isset($_POST["crearCuenta"])) {
                // Recoge los datos del formulario.
                $nombre = $_POST["nombre"];
                $contrasena = $_POST["contrasena"];
        
                // Verifica que los campos no estén vacíos (puedes agregar más validaciones si es necesario).
                if (!empty($nombre) && !empty($contrasena)) {
        
                    // Obtiene la conexión a la base de datos.
                    $conexion = db::entrar();
                    
                    // Crea una instancia de RepositorioUsuario pasando la conexión.
                    $repositorioUsuario = new usuarioRepositorio($conexion);
                    
                    // Inserta el usuario en la base de datos.
                    $exito = $repositorioUsuario->insertarUsuario($nombre, $contrasena);
        
                    if ($exito) {
                        // Redirige a la página de inicio de sesión u otra página según tus necesidades.
                        header('Location: ?menu=inicio');
                        exit();
                    } else {
                        // Manejo de errores si la inserción falla.
                        echo "Error al crear la cuenta.";
                    }
                } else {
                    // Manejo de errores si los campos están vacíos.
                    echo "Por favor, complete todos los campos.";
                }
        
            }          
            
        }

    }

}

registro::creacion();


?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro con Carga de Imágenes</title>
    <link rel="stylesheet" href="../estilos/estilosLogin.css">

</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="" method="POST" enctype="multipart/form-data" >
        <label for="usuario">Usuario:</label>
        <input type="text" id="nombre" name="nombre" ><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" ><br><br>
      
        <input type="submit" name="crearCuenta" value="Crear cuenta">
        <br>

        <a href="?menu=login">Login </a>


    </form>
</body>
</html>
