<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    

/*
   
    if(isset($_POST["login"])){
        header('Location: http://autoescueladaniels.com/formularios/login.php?');


    }
    */
    
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

<!--         <input type="submit" value="Login" name="login">
 -->        <a href="?menu=login">Login</a>






        
    </form>
    </body>
</html>