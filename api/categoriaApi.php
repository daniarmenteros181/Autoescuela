<?php
/* if ($_SERVER['REQUEST_METHOD']=='POST')
{

} */
require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta



if ($_SERVER['REQUEST_METHOD']=='GET')	
{
try {
    // Obtener la conexión a la base de datos utilizando la clase db
    $conexion = db::entrar();

    // Preparar y ejecutar la consulta para obtener todas las categorías
    $query = "SELECT id, nombre FROM categoria";
    $statement = $conexion->prepare($query);
    $statement->execute();

    // Obtener todas las categorías
    $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se encontraron categorías
    if ($categorias) {
        // Convertir a JSON y enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['categorias' => $categorias]);
    } else {
        // Si no se encuentran categorías, puedes manejarlo según tus necesidades
        header('HTTP/1.0 404 Not Found');
        echo json_encode(array('error' => 'No se encontraron categorías'));
    }
} catch (PDOException $e) {
    // Manejar errores de la base de datos según tus necesidades
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
}
} else {
// Método no permitido
echo json_encode(['error' => 'Método no permitido']);
}




/* 
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
} */
