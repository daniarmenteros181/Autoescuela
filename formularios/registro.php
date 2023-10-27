<?php








?>





<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro con Carga de Imágenes</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="registro.php" method="POST" enctype="multipart/form-data">
        <label for="usuario">Usuario:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

      

        

        <input type="submit" value="Crear cuenta">
        <br>
        <input type="submit" value="Iniciar sesion ">

    </form>
</body>
</html>
