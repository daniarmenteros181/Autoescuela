<?php
header( "Access-Control-Allow-Origin: *" );
require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta



if ($_SERVER['REQUEST_METHOD']=='POST')
{
    // Verificar si los datos necesarios están presentes en la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['nombre'])) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para agregar una nueva dificultad
            $query = "INSERT INTO dificultad (nombre) VALUES (:nombre)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':nombre', $data['nombre']);
            $statement->execute();

            // Obtener el ID de la nueva dificultad
            $nuevaDificultadId = $conexion->lastInsertId();

            // Preparar y ejecutar la consulta para obtener la nueva dificultad
            $query = "SELECT id, nombre FROM dificultad WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $nuevaDificultadId);
            $statement->execute();

            // Obtener la nueva dificultad
            $nuevaDificultad = $statement->fetch(PDO::FETCH_ASSOC);

            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['nuevaDificultad' => $nuevaDificultad]);

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
}



elseif ($_SERVER['REQUEST_METHOD']=='GET')	
{
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Preparar y ejecutar la consulta para obtener todas las dificultades
        $query = "SELECT id, nombre FROM dificultad";
        $statement = $conexion->prepare($query);
        $statement->execute();

        // Obtener todas las dificultades
        $dificultades = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si se encontraron dificultades
        if ($dificultades) {
            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['dificultades' => $dificultades]);
        } else {
            // Si no se encuentran dificultades, puedes manejarlo según tus necesidades
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'No se encontraron dificultades'));
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
} 



 elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{
 // Obtener el ID de la dificultad a eliminar desde la URL
 $id = $_GET['id'] ?? null;

 if ($id) {
     try {
         // Obtener la conexión a la base de datos utilizando la clase db
         $conexion = db::entrar();

         // Preparar y ejecutar la consulta para eliminar la dificultad
         $query = "DELETE FROM dificultad WHERE id = :id";
         $statement = $conexion->prepare($query);
         $statement->bindParam(':id', $id);
         $statement->execute();

         // Verificar si se eliminó la dificultad
         $filasAfectadas = $statement->rowCount();

         if ($filasAfectadas > 0) {
             // Dificultad eliminada con éxito
             header('Content-type: application/json');
             echo json_encode(['mensaje' => 'Dificultad eliminada con éxito']);
         } else {
             // No se encontró la dificultad con el ID proporcionado
             header('HTTP/1.0 404 Not Found');
             echo json_encode(['error' => 'No se encontró la dificultad con el ID proporcionado']);
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
    // Obtener datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si se proporcionan datos válidos
    if (isset($data['id']) && isset($data['nombre'])) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para actualizar la dificultad
            $query = "UPDATE dificultad SET nombre = :nombre WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $data['id']);
            $statement->bindParam(':nombre', $data['nombre']);
            $statement->execute();

            // Verificar si se actualizó la dificultad
            $filasAfectadas = $statement->rowCount();

            if ($filasAfectadas > 0) {
                // Dificultad actualizada con éxito
                header('Content-type: application/json');
                echo json_encode(['mensaje' => 'Dificultad actualizada con éxito']);
            } else {
                // No se encontró la dificultad con el ID proporcionado
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró la dificultad con el ID proporcionado']);
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
} 
