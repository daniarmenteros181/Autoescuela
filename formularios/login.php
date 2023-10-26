<?php

require_once "../helpers/sesion.php";
require_once "../helpers/login.php";



iniciaSesion();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreUsuario = $_POST["nombre"];
    $contra = $_POST["contra"];

    login($nombreUsuario,$contra);

    if(isset($_POST["registro"])){
      //  header('Location: http://localhost/Autoescuela/formularios/registro.php?');
        header('Location: http://autoescueladaniels.com/formularios/registro.php?');



    }
    
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Formulario</title>
</head>
<body>
    <h1>Formulario</h1>
    <form id="miFormulario" method="post" action="login.php">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="contra">Contraseña:</label>
        <input type="text" id="contra" name="contra"><br><br>

        

        <input type="submit" value="Entrar" name="entrar">

        <input type="submit" value="Registro" name="registro">

        
    </form>
    </body>
</html>