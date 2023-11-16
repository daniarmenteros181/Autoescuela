<?php

class login{

public static function procesarFormulario() {



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreUsuario = $_POST["nombre"];
    $contra = $_POST["contra"];
    funcionesLogin::login($nombreUsuario,$contra);
    
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

    <div id="coge">
    <form id="miFormulario" method="post" action="">

        <label for="nombre">Usuario:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="contra">Contraseña:</label>
        <input type="text" id="contra" name="contra"><br><br>


        <input type="submit" value="Entrar" name="entrar">
        <br>

        <a href="?menu=registro">Registro</a>

        <br>
        <a href="?menu=olvido">¿Has olvidado tu contraseña?</a>

        
    </form>
    </div>
    </body>
</html>