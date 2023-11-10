<?php 

Class cargador{

public static function autocargar(){
    spl_autoload_register('autocarga');

}
}

function autocarga($clase){
	if(file_exists($_SERVER["DOCUMENT_ROOT"]."/helpers" . "/" .$clase .".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/helpers" . "/" . $clase .".php";

    }
    else if(file_exists($_SERVER["DOCUMENT_ROOT"]."/formularios"."/".$clase.".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/formularios"."/".$clase.".php";

    }else if(file_exists($_SERVER["DOCUMENT_ROOT"]."/repositorio"."/".$clase.".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/repositorio"."/".$clase.".php";

    }
    else if(file_exists($_SERVER["DOCUMENT_ROOT"]."/entidades"."/".$clase.".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/entidades"."/".$clase.".php";

    }
    else if(file_exists($_SERVER["DOCUMENT_ROOT"]."/examen"."/".$clase.".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/examen"."/".$clase.".php";

    }
    else if(file_exists($_SERVER["DOCUMENT_ROOT"]."/api"."/".$clase.".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/api"."/".$clase.".php";

    }else if(file_exists($_SERVER["DOCUMENT_ROOT"]."/vista"."/".$clase.".php")){
        require_once $_SERVER["DOCUMENT_ROOT"]."/vista"."/".$clase.".php";

    }

}

// Llama a la función autocargar para que se ejecute
cargador::autocargar();


?>