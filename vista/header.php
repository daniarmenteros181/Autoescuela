<?php

sesion::iniciaSesion();
 if(funcionesLogin::estarLogeado()){

$nombreUsuario = sesion::leerSesion('nombreUsuario');
echo "¡Bienvenido, $nombreUsuario!"; 
}


/* if(!funcionesLogin::estarLogeado()){
 */
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./estilos/estilosPrincipal.css">
        <title>Document</title>
    </head>
    <body>
    <header>
        <nav >
            <div id="primer">
                    <!-- <div>
                        <img  src="./imagenes/circula.jpg" alt=" ">
                    </div> -->
                    <div id="deBtn">
                        <div>
                        <a href="?menu=login" class="btn">Login </a>

                        </div>
                        <div>
                        <a href="?menu=registro" class="btn">Registrarse</a>

                        </div>
                        <div>
                        <a href="?menu=inicio" class="btn">Inicio</a>

                        </div>
                    </div>
            </div>
            
        </nav>
      
    </header>

        
    </body>
    </html>
    <?php

/* } else { */
    // El usuario está logueado, puedes mostrar un mensaje o redirigir a otra página si es necesario
/*     require_once './formularios/alumnoMenu.php';
 */



/* } */
?>





        




