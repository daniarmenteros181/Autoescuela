<?php
header( "Access-Control-Allow-Origin: *" );
require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si los datos necesarios están presentes
    if (isset($data['nombre']) && isset($data['descripcion'])) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para agregar un nuevo examen
            $query = "INSERT INTO examen (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':nombre', $data['nombre']);
            $statement->bindParam(':descripcion', $data['descripcion']);
            $statement->execute();

            // Obtener el ID del nuevo examen
            $nuevoExamenId = $conexion->lastInsertId();

            // Preparar y ejecutar la consulta para obtener el nuevo examen
            $query = "SELECT id, nombre, descripcion FROM examen WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $nuevoExamenId);
            $statement->execute();

            // Obtener el nuevo examen
            $nuevoExamen = $statement->fetch(PDO::FETCH_ASSOC);

            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['nuevoExamen' => $nuevoExamen]);

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


    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_examen'])) {
        $idExamen = intval($_GET['id_examen']);
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para obtener todas las preguntas asociadas a un examen
            $query = "SELECT p.id, p.enunciado, c.nombre AS categoria, d.nombre AS dificultad,
                              p.respuesta1 AS res1, p.respuesta2 AS res2, p.respuesta3 AS res3
                      FROM pregunta p
                      INNER JOIN categoria c ON p.id_categoria = c.id
                      INNER JOIN dificultad d ON p.id_dificultad = d.id
                      INNER JOIN examen_pregunta ep ON p.id = ep.id_pregunta
                      WHERE ep.id_examen = :idExamen";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);
            $statement->execute();

            // Obtener todas las preguntas asociadas al examen
            $preguntas = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Modificar la estructura de las preguntas
            $preguntasConRespuestas = [];
            foreach ($preguntas as $pregunta) {
                $preguntaConRespuesta = [
                    'id' => $pregunta['id'],
                    'enunciado' => $pregunta['enunciado'],
                    'categoria' => $pregunta['categoria'],
                    'dificultad' => $pregunta['dificultad'],
                    'respuesta' => [
                        'res1' => $pregunta['res1'],
                        'res2' => $pregunta['res2'],
                        'res3' => $pregunta['res3']
                    ]
                ];
                $preguntasConRespuestas[] = $preguntaConRespuesta;
            }

            // Verificar si se encontraron preguntas
            if ($preguntasConRespuestas) {
                // Convertir a JSON y enviar la respuesta
                header('Content-type: application/json');
                echo json_encode(['preguntas' => $preguntasConRespuestas]);
            } else {
                // Si no se encuentran preguntas, puedes manejarlo según tus necesidades
                header('HTTP/1.0 404 Not Found');
                echo json_encode(array('error' => 'No se encontraron preguntas para el examen especificado'));
            }
        } catch (PDOException $e) {
            // Manejar errores de la base de datos según tus necesidades
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
        }
    }
} 
  

 /*   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Obtener la conexión a la base de datos utilizando la clase db
    $conexion = db::entrar();

    // Preparar y ejecutar la consulta para obtener todos los exámenes
    $query = "SELECT id FROM examen";
    $statement = $conexion->query($query);

    // Obtener todos los exámenes
    $examenes = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se encontraron exámenes
    if ($examenes) {
        // Convertir a JSON y enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['examenes' => $examenes]);
    } else {
        // Si no se encuentran exámenes, puedes manejarlo según tus necesidades
        header('HTTP/1.0 404 Not Found');
        echo json_encode(['error' => 'No se encontraron exámenes']);
    }
} else {
    // Método no permitido
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}  */  


elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID del examen a eliminar desde la URL
    $id = $_GET['id'] ?? null;

    if ($id) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para eliminar el examen
            $query = "DELETE FROM examen WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            // Verificar si se eliminó el examen
            $filasAfectadas = $statement->rowCount();

            if ($filasAfectadas > 0) {
                // Examen eliminado con éxito
                header('Content-type: application/json');
                echo json_encode(['mensaje' => 'Examen eliminado con éxito']);
            } else {
                // No se encontró el examen con el ID proporcionado
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró el examen con el ID proporcionado']);
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

elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si se proporcionan datos válidos
    if (isset($data['id']) && isset($data['nombre']) && isset($data['descripcion'])) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para actualizar el examen
            $query = "UPDATE examen SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $data['id']);
            $statement->bindParam(':nombre', $data['nombre']);
            $statement->bindParam(':descripcion', $data['descripcion']);
            $statement->execute();

            // Verificar si se actualizó el examen
            $filasAfectadas = $statement->rowCount();

            if ($filasAfectadas > 0) {
                // Examen actualizado con éxito
                header('Content-type: application/json');
                echo json_encode(['mensaje' => 'Examen actualizado con éxito']);
            } else {
                // No se encontró el examen con el ID proporcionado
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró el examen con el ID proporcionado']);
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
