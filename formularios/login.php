<?php

require_once "../helpers/sesion.php";
require_once "../helpers/login.php";



iniciaSesion();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreUsuario = $_POST["nombre"];
    $contra = $_POST["contra"];

    login($nombreUsuario,$contra);

    if(isset($_POST["registro"])){
        header('Location: http://autoescueladaniels.com/formularios/registro.php?');



    }
    
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Inicio Sesion </title>
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

        <a href="">¿Has olvidado tu contraseña?</a>

        
    </form>
    </body>
</html>