<?php

#metodos
#esta logueado(le pregunta a sesion si tiene clave que se llama users)
function estarLogeado(){

    if (isset($_SESSION['nombreUsuario'])) {
        return true;
    } else {
        return false;
    }
    

}

#logIn
function login($nombre,$contra){
    if (isset($_POST["entrar"])) {
        // Llamar a la función login para verificar las credenciales
        if (esxisteUser($nombre, $contra)) {
            // Las credenciales son correctas, establecer la sesión y redirigir
            guardaSesion('nombreUsuario',crearUsuario());    

           // header('Location: http://primeroenlafrente.com/pri.php'); // Cambia la URL según tus necesidades
            
            //Por si quiero que salga arriba con quien he accedido
              header('Location:http://primeroenlafrente.com/pri.php?nombreUsuario=' . $nombreUsuario);


        } else {
            // Las credenciales son incorrectas, mostrar un mensaje de error
            echo "Acceso denegado. Nombre o contraseña incorrectos.";
        }
    }
}

#logOut

?>