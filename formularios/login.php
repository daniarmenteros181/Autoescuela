<?php

require_once "../helpers/sesion.php";
require_once "../helpers/login.php";

//sesion::iniciaSesion;

iniciaSesion();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreUsuario = $_POST["nombre"];
    $contra = $_POST["contra"];

    login($nombreUsuario,$contra);

    if(isset($_POST["registro"])){
        header('Location: http://autoescueladaniels.com/formularios/registro.php?');



    }
    if(isset($_POST["olvido"])){
        header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');


    }
    
}


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