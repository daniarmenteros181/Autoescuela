<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once 'index.php';

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
     
    }
    if ($_GET['menu'] == "admin") {
        require_once './formularios/adminMenu.php';
     
    }if ($_GET['menu'] == "espera") {
        require_once './formularios/espera.php';
     
    }
    
    
}