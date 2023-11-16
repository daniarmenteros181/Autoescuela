<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Contraseña </title>
    <link rel="stylesheet" href="../estilos/estilosLogin.css">

</head>
<body>
    <h1>Recuperar Contraseña </h1>
    <form id="miFormulario" method="post">

        <label for="email">Correo Electronico:</label>
        <input type="text" id="email" name="email"><br><br>

        
        <input type="submit" value="Enviar" name="enviar">
      <a href="?menu=login">Login</a>






        
    </form>
    </body>
</html>