<?php
header( "Access-Control-Allow-Origin: *" );
require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del cuerpo de la solicitud
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json, true);

    // Verificar si los datos necesarios están presentes
    if (
        isset($datos['enunciado']) &&
        isset($datos['respuesta1']) &&
        isset($datos['respuesta2']) &&
        isset($datos['respuesta3']) &&
        isset($datos['id_categoria']) &&
        isset($datos['id_dificultad']) &&
        isset($datos['correcta']) &&
        isset($datos['url']) &&
        isset($datos['tipo_url'])
    ) {
        try {
            $conexion = db::entrar();
    
            // Preparar la consulta para insertar una nueva pregunta
            $query = "INSERT INTO pregunta (enunciado, respuesta1, respuesta2, respuesta3, id_categoria, id_dificultad, correcta, url, tipo_url) 
                      VALUES (:enunciado, :respuesta1, :respuesta2, :respuesta3, :id_categoria, :id_dificultad, :correcta, :url, :tipo_url)";
            $statement = $conexion->prepare($query);
    
            // Vincular parámetros
            $statement->bindParam(':enunciado', $datos['enunciado'], PDO::PARAM_STR);
            $statement->bindParam(':respuesta1', $datos['respuesta1'], PDO::PARAM_STR);
            $statement->bindParam(':respuesta2', $datos['respuesta2'], PDO::PARAM_STR);
            $statement->bindParam(':respuesta3', $datos['respuesta3'], PDO::PARAM_STR);
            $statement->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
            $statement->bindParam(':id_dificultad', $datos['id_dificultad'], PDO::PARAM_INT);
            $statement->bindParam(':correcta', $datos['correcta'], PDO::PARAM_STR);
            $statement->bindParam(':url', $datos['url'], PDO::PARAM_STR);
            $statement->bindParam(':tipo_url', $datos['tipo_url'], PDO::PARAM_STR);
    
            // Ejecutar la consulta
            $statement->execute();
    
            // Obtener el ID de la nueva pregunta
            $nuevaPreguntaID = $conexion->lastInsertId();
    
            // Devolver una respuesta con el ID de la nueva pregunta
            header('Content-type: application/json');
            echo json_encode(array('id' => $nuevaPreguntaID));
    
        } catch (PDOException $e) {
            // Manejar errores de la base de datos según tus necesidades
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
        }
    } else {
        // Datos incompletos, devolver un mensaje de error
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'Datos incompletos'));
    }
}


   


 elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Preparar y ejecutar la consulta para obtener todas las preguntas con información de categoría y dificultad
        $query = "SELECT p.id, p.enunciado, c.nombre AS categoria, d.nombre AS dificultad,
                          p.respuesta1 AS res1, p.respuesta2 AS res2, p.respuesta3 AS res3
                  FROM pregunta p
                  INNER JOIN categoria c ON p.id_categoria = c.id
                  INNER JOIN dificultad d ON p.id_dificultad = d.id";
        $statement = $conexion->prepare($query);
        $statement->execute();

        // Obtener todas las preguntas con información de categoría y dificultad
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
            echo json_encode(array('error' => 'No se encontraron preguntas'));
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
}



elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID de la pregunta a eliminar desde la URL
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para eliminar la pregunta
            $query = "DELETE FROM pregunta WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            // Verificar si se eliminó la pregunta
            $filasAfectadas = $statement->rowCount();

            if ($filasAfectadas > 0) {
                // Pregunta eliminada con éxito
                header('Content-type: application/json');
                echo json_encode(['mensaje' => 'Pregunta eliminada con éxito']);
            } else {
                // No se encontró la pregunta con el ID proporcionado
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró la pregunta con el ID proporcionado']);
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
    if (
        isset($data['id']) &&
        isset($data['enunciado']) &&
        isset($data['respuesta1']) &&
        isset($data['respuesta2']) &&
        isset($data['respuesta3']) &&
        isset($data['id_categoria']) &&
        isset($data['id_dificultad']) &&
        isset($data['correcta']) &&
        isset($data['url']) &&
        isset($data['tipo_url'])
    ) {
        try {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para actualizar la pregunta
            $query = "UPDATE pregunta SET 
                      enunciado = :enunciado, 
                      respuesta1 = :respuesta1, 
                      respuesta2 = :respuesta2, 
                      respuesta3 = :respuesta3, 
                      id_categoria = :id_categoria, 
                      id_dificultad = :id_dificultad, 
                      correcta = :correcta, 
                      url = :url, 
                      tipo_url = :tipo_url 
                      WHERE id = :id";

            $statement = $conexion->prepare($query);

            // Vincular parámetros
            $statement->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $statement->bindParam(':enunciado', $data['enunciado'], PDO::PARAM_STR);
            $statement->bindParam(':respuesta1', $data['respuesta1'], PDO::PARAM_STR);
            $statement->bindParam(':respuesta2', $data['respuesta2'], PDO::PARAM_STR);
            $statement->bindParam(':respuesta3', $data['respuesta3'], PDO::PARAM_STR);
            $statement->bindParam(':id_categoria', $data['id_categoria'], PDO::PARAM_INT);
            $statement->bindParam(':id_dificultad', $data['id_dificultad'], PDO::PARAM_INT);
            $statement->bindParam(':correcta', $data['correcta'], PDO::PARAM_STR);
            $statement->bindParam(':url', $data['url'], PDO::PARAM_STR);
            $statement->bindParam(':tipo_url', $data['tipo_url'], PDO::PARAM_STR);

            // Ejecutar la consulta
            $statement->execute();

            // Verificar si se actualizó la pregunta
            $filasAfectadas = $statement->rowCount();

            if ($filasAfectadas > 0) {
                // Pregunta actualizada con éxito
                header('Content-type: application/json');
                echo json_encode(['mensaje' => 'Pregunta actualizada con éxito']);
            } else {
                // No se encontró la pregunta con el ID proporcionado
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró la pregunta con el ID proporcionado']);
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
