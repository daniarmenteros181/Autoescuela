<?php

require_once '../cargador.php';
cargador::autocargar();


class login{

public static function procesarFormulario() {


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreUsuario = $_POST["nombre"];
    $contra = $_POST["contra"];

   // sesion::iniciaSesion(); // Llama al método iniciarSesion para iniciar la sesión


    funcionesLogin::login($nombreUsuario,$contra);

    if(isset($_POST["registro"])){
        header('Location: http://autoescueladaniels.com/formularios/registro.php?');



    }
    if(isset($_POST["olvido"])){
        header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');


    }
    
}
}
}

login::procesarFormulario();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Inicio Sesion </title>
    <link rel="stylesheet" href="../estilos/estilosLogin.css">
</head>
<body>
    <h1>Inicio Sesion</h1>
    <form id="miFormulario" method="post" action="login.php">

        <label for="nombre">Usuario:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="contra">Contraseña:</label>
        <input type="text" id="contra" name="contra"><br><br>

        

        <input type="submit" value="Entrar" name="entrar">
        <br>

        <input type="submit" value="Registro" name="registro">

        <br>
        <input type="submit" value="¿Has olvidado tu contraseña?" name="olvido">


        
    </form>
    </body>
</html>