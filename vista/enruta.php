<?php
 if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './formularios/inicio.php';

    }if ($_GET['menu'] == "login") {
        require_once './formularios/login.php';
     
    }if ($_GET['menu'] == "registro") {
        require_once './formularios/registro.php';
     
    }if ($_GET['menu'] == "olvido") {
        require_once './formularios/recuperarContrasenia.php';
     
    } if ($_GET['menu'] == "profesor") {
        require_once './formularios/profesorMenu.php';
     
    } if ($_GET['menu'] == "alumno") {
        require_once './formularios/alumnoMenu.php';
     
    }if ($_GET['menu'] == "admin") {
        require_once './formularios/adminMenu.php';
     
    }if ($_GET['menu'] == "espera") {
        require_once './formularios/espera.php';
     
    }if ($_GET['menu']=="notasVer"){
        require_once './formularios/verNotas.php';

    }if ($_GET['menu']=="notasVerExam"){
        require_once './formularios/verNotasExamen.php';

    }if ($_GET['menu']=="administrarExam"){
        require_once './formularios/administrarExamenes.php';

    }if ($_GET['menu']=="hacerExam"){
        require_once './examen/index.html';

    }if ($_GET['menu']=="adminitrar"){
        require_once './formularios/confirmarAlumnos.php';

    }if ($_GET['menu']=="hacerExam"){
        require_once './examen/index.html';

    }
}else {
    // Si no se proporciona el parámetro 'menu', carga la sección de "inicio" por defecto
    require_once './formularios/inicio.php';
}





/*
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './formularios/inicio.php';
    } elseif ($_GET['menu'] == "login") {
        require_once './formularios/login.php';
    } elseif ($_GET['menu'] == "registro") {
        require_once './formularios/registro.php';
    } elseif ($_GET['menu'] == "olvido") {
        require_once './formularios/recuperarContrasenia.php';
    } elseif ($_GET['menu'] == "profesor") {
        require_once './formularios/profesorMenu.php';
    } elseif ($_GET['menu'] == "alumno") {
        require_once './formularios/alumnoMenu.php';
    } elseif ($_GET['menu'] == "admin") {
        require_once './formularios/adminMenu.php';
    } elseif ($_GET['menu'] == "espera") {
        require_once './formularios/espera.php';
    } elseif ($_GET['menu'] == "notasVer") {
        require_once './formularios/verNotas.php';
    } elseif ($_GET['menu'] == "notasVerExam") {
        require_once './formularios/verNotasExamen.php';
    } elseif ($_GET['menu'] == "administrarExam") {
        require_once './formularios/administrarExamenes.php';
    } elseif ($_GET['menu'] == "hacerExam") {
        require_once './examen/index.html';
    } else {
        // Si el parámetro 'menu' no coincide con ninguna opción, carga la sección de "inicio" por defecto
        require_once './formularios/inicio.php';
    }
} else {
    // Si no se proporciona el parámetro 'menu', carga la sección de "inicio" por defecto
    require_once './formularios/inicio.php';
}

*/

?>



