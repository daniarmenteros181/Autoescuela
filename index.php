<?php

require_once 'cargador.php';

// Llama a la función autocargar para registrar el cargador
cargador::autocargar();


class Principal
{
    public static function main()
    {

        // Ahora puedes requerir la clase login.php después de cargar los cargadores
        require_once 'vista/vistas.php';

        }
        
}
Principal::main();






?>
