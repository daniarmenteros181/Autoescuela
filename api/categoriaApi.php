<?php
header( "Access-Control-Allow-Origin: *" );
require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta


 if ($_SERVER['REQUEST_METHOD']=='POST')
// Verificar si los datos necesarios están presentes en la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nombre'])) {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Preparar y ejecutar la consulta para agregar una nueva categoría
        $query = "INSERT INTO categoria (nombre) VALUES (:nombre)";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':nombre', $data['nombre']);
        $statement->execute();

        // Obtener el ID de la nueva categoría
        $nuevaCategoriaId = $conexion->lastInsertId();

        // Preparar y ejecutar la consulta para obtener la nueva categoría
        $query = "SELECT id, nombre FROM categoria WHERE id = :id";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':id', $nuevaCategoriaId);
        $statement->execute();

        // Obtener la nueva categoría
        $nuevaCategoria = $statement->fetch(PDO::FETCH_ASSOC);

        // Convertir a JSON y enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['nuevaCategoria' => $nuevaCategoria]);

    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}


elseif ($_SERVER['REQUEST_METHOD']=='GET')	
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
}




elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{
       // Obtener el ID de la categoría a eliminar desde la URL
       $id = isset($_GET['id']) ? intval($_GET['id']) : null;

       if ($id) {
           try {
               // Obtener la conexión a la base de datos utilizando la clase db
               $conexion = db::entrar();
   
               // Preparar y ejecutar la consulta para eliminar la categoría
               $query = "DELETE FROM categoria WHERE id = :id";
               $statement = $conexion->prepare($query);
               $statement->bindParam(':id', $id);
               $statement->execute();
   
               // Verificar si se eliminó la categoría
               $filasAfectadas = $statement->rowCount();
   
               if ($filasAfectadas > 0) {
                   // Categoría eliminada con éxito
                   header('Content-type: application/json');
                   echo json_encode(['mensaje' => 'Categoría eliminada con éxito']);
               } else {
                   // No se encontró la categoría con el ID proporcionado
                   header('HTTP/1.0 404 Not Found');
                   echo json_encode(['error' => 'No se encontró la categoría con el ID proporcionado']);
               }
   
           } catch (PDOException $e) {
               // Manejar errores de la base de datos según tus necesidades
               header('HTTP/1.1 500 Internal Server Error');
               echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
           }
       } else {
           // ID no proporcionado en la solicitud
           header('HTTP/1.0 400 Bad Request');
           echo json_encode(['error' => 'ID no proporcionado en la solicitud']);
       }
   }



elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        // Obtener datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Verificar si se proporcionan datos válidos
        if (isset($data['id']) && isset($data['nombre'])) {
            try {
                // Obtener la conexión a la base de datos utilizando la clase db
                $conexion = db::entrar();
    
                // Preparar y ejecutar la consulta para actualizar la categoría
                $query = "UPDATE categoria SET nombre = :nombre WHERE id = :id";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':id', $data['id']);
                $statement->bindParam(':nombre', $data['nombre']);
                $statement->execute();
    
                // Verificar si se actualizó la categoría
                $filasAfectadas = $statement->rowCount();
    
                if ($filasAfectadas > 0) {
                    // Categoría actualizada con éxito
                    header('Content-type: application/json');
                    echo json_encode(['mensaje' => 'Categoría actualizada con éxito']);
                } else {
                    // No se encontró la categoría con el ID proporcionado
                    header('HTTP/1.0 404 Not Found');
                    echo json_encode(['error' => 'No se encontró la categoría con el ID proporcionado']);
                }
    
            } catch (PDOException $e) {
                // Manejar errores de la base de datos según tus necesidades
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
            }
        } else {
            // Datos insuficientes en la solicitud
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'Datos insuficientes en la solicitud']);
        }
    } else {
        // Método no permitido
        header('HTTP/1.0 405 Method Not Allowed');
        echo json_encode(['error' => 'Método no permitido']);
    }
} 
