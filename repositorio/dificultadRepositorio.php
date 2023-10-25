<?php

require_once "db.php";


function meteProductos() {
    $productos = array(); // Crear un arreglo para almacenar los productos
    $db = db::entrar();
    $resultado = $db->query("select * from dificultad");

    // bucle while para recorrer los resultados de la consulta.
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $productos[] = $row; // Agregar el producto al arreglo
    }

    return $productos; // Devolver el arreglo de productos
}

?>