<?php

require_once "db.php";

require_once "dificultadRepositorio.php";



$db = db::entrar();

$resultado = $db->query("select * from dificultad");

    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {

        echo "ID : " . $row ['id'] . ", nombre : " . $row ['nombre'];

        

    }

    /*Utilizando el metodo de la clase dificultadRepositorio*/
    /*
    $productos = meteProductos(); // Llama a la función y almacena el resultado en $productos



    foreach ($productos as $producto) {
        echo $producto['nombre']; // Suponiendo que 'nombre' sea un campo en tus datos
        echo '<br>'; // Agrega un salto de línea para separar los elementos
    }
    */
?>