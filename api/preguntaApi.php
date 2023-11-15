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


   


/* if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
} else {
    // Método no permitido
    echo json_encode(['error' => 'Método no permitido']);
} */



/* elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}
 */