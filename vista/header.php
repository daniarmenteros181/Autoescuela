<?php

sesion::iniciaSesion();
if(funcionesLogin::estarLogeado()){

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
<!--         <nav >
 -->       
            <div id="seg">
                <img src="./imagenes/olalla_logo.jpg" id="ola" alt="">
            </div>     
            <div id="primer">
                    <!-- <div>
                        <img  src="./imagenes/circula.jpg" alt=" ">
                    </div> -->
                    <div id="deBtn">
                        <div>
                         <a href="?menu=inicio" class="btn">Cerrar Sesion </a>


                        </div>               
                        <div>
                        <a href="?menu=inicio" class="btn">Inicio</a>

                        </div>
                        
                    </div>
            </div>
            <div id="ter">
            <div id="quien">
                        <?php

                        $nombreUsuario = sesion::leerSesion('nombreUsuario');
                        echo "¡Bienvenido, $nombreUsuario!";
                        ?>
            </div>

            </div>   
                  
<!--         </nav>     
 -->    </header>    
    </body>
    </html>
 <?php

}else{
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
<!--         <nav >
 -->        <div id="seg">
                <img src="./imagenes/olalla_logo.jpg" id="ola" alt="">
            </div>

            <div id="primer">
                   
                    <div id="deBtn">
                        <div>
                        <a href="?menu=login" class="btn">Login </a>

                        </div>
                        <!-- <div>
                        <a href="?menu=registro" class="btn">Registrarse</a>

                        </div> -->
                        <div>
                        <a href="?menu=inicio" class="btn">Inicio</a>

                        </div>
                    </div>
            </div>

            <div id="ter">
            </div> 
            
<!--         </nav>
 -->    </header>

    </body>
    </html>
    <?php

}
?>






        




