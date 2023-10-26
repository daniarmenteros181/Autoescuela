<?php

require_once "../repositorio/db.php";

#esta logueado(le pregunta a sesion si tiene clave que se llama users)
function estarLogeado(){

    if (isset($_SESSION['nombreUsuario'])) {
        return true;
    } else {
        return false;
    }
    

}

// Función para verificar el inicio de sesión en la base de datos
function existeUsuario($nombre, $contra) {

    
    // Conectar a la base de datos utilizando la clase db
    $conexion = db::entrar();

    // Consultar la base de datos para encontrar un usuario con el nombre proporcionado
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE nombre = ? AND contrasenia = ?");

    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $contra);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    // Verificar si se encontró un usuario con ese nombre y contraseña
    if ($usuario) {
        // Iniciar la sesión si es necesario
        // iniciaSesion();

        return true;
    }
    
    /*
    // Esto por si la contraseña esta de la otra manera almacenada en la base de datos
    if ($usuario && password_verify($contra, $usuario['contrasenia'])) {
        // Iniciar la sesión
        //iniciaSesion();
       

        return true;
    }
    */

    return false;
}




#logIn
function login($nombre,$contra){
    if (isset($_POST["entrar"])) {

        



        if (existeUsuario($nombre, $contra)) {
            // Las credenciales son correctas, establecer la sesión y redirigir
            header('Location: http://autoescueladaniels.com/formularios/registro.php?');


        } else {
          
            // Las credenciales son incorrectas, mostrar un mensaje de error
            echo "Acceso denegado. Nombre o contraseña incorrectos.";
        }
    }
}


function crearUsuario(){

    return new Usuario($nombreUsuario,$contra,"users");
 

}

#logOut

?>