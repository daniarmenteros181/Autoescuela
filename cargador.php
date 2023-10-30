<?php 

/** Autocargador de librerias **/
spl_autoload_register('autocargador');

function autocargador($insNom)
{
	include $insNom . '.class.php';
}



?>