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
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <label for="imagen">Subir Imagen de Perfil:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>

        <label for="pdf">Subir PDF:</label>
        <input type="file" id="pdf" name="pdf" accept=".pdf" required><br><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
