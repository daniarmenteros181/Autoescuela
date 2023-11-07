<?php




?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilosMenu.css">


</head>
<body>
   


    <form id="miFormulario" method="post" action="alumnoMenu.php?nombreUsuario=<?php echo $nombreUsuario; ?>">
    <div class="menu">
        <ul>
            <li><a href="#">Ver Notas</a></li>
            <li class="dropdown">
                <a href="#">Crear Examen</a>
                <div class="dropdown-content">
                    <a href="#">Aleatorio</a>
                    <a href="#">Dificultad
                        
                    </a>
                    <div class="submenu">
                        <a href="#">Fácil</a>
                        <a href="#">Medio</a>
                        <a href="#">Difícil</a>
                    </div>
                </div>
            </li>
            <li><a href="#">Administrar Exámenes</a></li>
            <li><a href="#">Verificar Alumnos</a></li>

        </ul>
    </div>
    

        
        <input type="submit" value="out" name="out">



    </form>


    </form>
</body>
</html>