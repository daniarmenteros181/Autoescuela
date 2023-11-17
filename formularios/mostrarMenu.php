<?php
class mostrarMenu{

//Clase con funciones estaticas para cuando se loguea alguien, muestre un menu dependiendo de quien se haya logueado

//Menu de Administrador
     public static function mostrarMenuAdmin(){
        ?>
        <!DOCTYPE html>
    <html>
    <head>
        <title>Admin</title>
    </head>
    <body>
    
        <form id="miFormulario" method="post" action="">
        <div class="menu">
            <ul>
                <li><a href="?menu=verNotas">Ver Notas</a></li>
                <li class="dropdown">
                    <a href="?menu=crearExam">Crear Examen</a>
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
                <li><a href="?menu=adminExamen">Administrar Exámenes</a></li>
                <li><a href="?menu=adminitrar">Verificar Alumnos</a></li>
                <li><a href="?menu=crearPreg">Crear pregunta</a></li>
                <li><a href="?menu=leerPreg">Leer preguntas</a></li>
    
                <li><input type="submit" class="cierre" value="Cerrar Sesion" name="out"></li>
            </ul>  
        </div>
        </form>
    </body>
    </html>
    <?php
    } 

    
//Menu de alumno
public static function mostrarMenuAlumno(){
?>
<!DOCTYPE html>
<html>
<head>
<title>Alumno</title>
</head>
<body> 
    <form id="miFormulario" method="post" action="">
        <div class="menu">
        <ul>
           <li class="dropdown">
                <a href="?menu=hacerExam">Hacer Examen</a>
                <div class="dropdown-content">
                    <a href="#">Aleatorio</a>
                    <a href="#">Por profesor
                        
                    </a>
                    <div class="submenu">
                        <a href="#">Fácil</a>
                        <a href="#">Medio</a>
                        <a href="#">Difícil</a>
                    </div>
                </div>
            </li>
            <li><input type="submit" class="cierre" value="Cerrar Sesion" name="out"></li>
        </ul>
    </div>
    </form>
</body>
</html>
<?php
}


//Menu de profesor
public static function mostrarMenuProfesor(){
?>
<!DOCTYPE html>
<html>
<head>
<title>Profesor</title>
</head>
<body>
   
<form id="miFormulario" method="post" action="">
        <div class="menu">
            <ul>
                <li class="dropdown">
                    <a href="?menu=crearExam">Crear Examen</a>
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
                <li><a href="?menu=adminExamen">Administrar Exámenes</a></li>
                <li><a href="?menu=crearPreg">Crear pregunta</a></li>
                <li><a href="?menu=leerPreg">Leer preguntas</a></li>
                <li><input type="submit" class="cierre" value="Cerrar Sesion" name="out"></li>
            </ul>
        </div>
        </form>
</body>
</html>
<?php
} 

}
