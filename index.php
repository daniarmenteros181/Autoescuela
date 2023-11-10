<?php

class Principal
{
    public static function main()
    {

        // Ahora puedes requerir la clase login.php después de cargar los cargadores
        require_once 'cargador.php';
        require_once 'vista/layout.php';

        }
        
}
Principal::main();






?>
