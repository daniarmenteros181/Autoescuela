<?php

sesion::iniciaSesion();
//$nombreUsuario = sesion::leerSesion('nombreUsuario');
//echo "¡Bienvenido, $nombreUsuario!"; 




if(!funcionesLogin::estarLogeado()){

    ?>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="./imagenes/logo.png" alt="">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="?menu=login">LOGIN <span class="sr-only">(current)</span></a>
                    </li>
                    <a class="nav-link" href="?menu=inicio">INICIO <span class="sr-only">(current)</span></a>      
                </ul>
            </div>
        </nav>
      
    </header>
    </body>
</html>
    <?php

} else {
    // El usuario está logueado, puedes mostrar un mensaje o redirigir a otra página si es necesario


}
?>



        




