<?php

class funcionesLogin{


#esta logueado(le pregunta a sesion si tiene clave que se llama users)
//public static function
    public static function estarLogeado(){

    if (isset($_SESSION['nombreUsuario'])) {
        return true;
    } else {
        return false;
    }
    

}

// Función para verificar el inicio de sesión en la base de datos
 public static function existeUsuario($nombreUsuario, $contra) {

    
    // Conectar a la base de datos utilizando la clase db
    $conexion = db::entrar();

    // Consultar la base de datos para encontrar un usuario con el nombre proporcionado
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE nombre = ? AND contrasenia = ?");

    $stmt->bindParam(1, $nombreUsuario);
    $stmt->bindParam(2, $contra);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    // Verificar si se encontró un usuario con ese nombre y contraseña
    if ($usuario) {
        // Iniciar la sesión si es necesario
         sesion::iniciaSesion();

         $rol = $usuario['rol'];

        // Redirigir al usuario según su rol
        if ($rol === 'admin') {
            header('Location: http://autoescueladaniels.com/formularios/adminMenu.php?nombreUsuario=' . $nombreUsuario);
        } elseif ($rol === 'profesor') {
            header('Location: http://autoescueladaniels.com/formularios/profesorMenu.php?nombreUsuario=' . $nombreUsuario);
        } elseif($rol === 'alumno' ) {
            header('Location: http://autoescueladaniels.com/formularios/alumnoMenu.php?nombreUsuario=' . $nombreUsuario);
        }elseif($rol ===''){
            header('Location: http://autoescueladaniels.com/formularios/espera.php?');


        }

        return true;
    }

    
   

    return false;
}

#logIn
    public static function login($nombreUsuario,$contra){
    if (isset($_POST["entrar"])) {

        if (funcionesLogin::existeUsuario($nombreUsuario, $contra)) {
            // Las credenciales son correctas, establecer la sesión y redirigir
            //sesion::guardaSesion('nombreUsuario',funcionesLogin::crearUsuario());


        } else {
          
            // Las credenciales son incorrectas, mostrar un mensaje de error
            echo "Acceso denegado. Nombre o contraseña incorrectos.";
        }
    }
}


    public static function crearUsuario(){

    return new Usuario($nombreUsuario,$contra);
 

}



}

#logOut


 /*
    // Esto por si la contraseña esta de la otra manera almacenada en la base de datos
    if ($usuario && password_verify($contra, $usuario['contrasenia'])) {
        // Iniciar la sesión
        //iniciaSesion();
       

        return true;
    }
    */


                //sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);
                //header('Location: http://autoescueladaniels.com/formularios/alumnoMenu.php?nombreUsuario=' . $nombreUsuario);


?>