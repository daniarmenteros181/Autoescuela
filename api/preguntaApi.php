<?php
header( "Access-Control-Allow-Origin: *" );

require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta

if ($_SERVER['REQUEST_METHOD']=='POST')
{

}
   

/* if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Preparar y ejecutar la consulta para obtener todas las preguntas
        $query = "SELECT id, enunciado, respuesta1, respuesta2, respuesta3 FROM pregunta";
        $statement = $conexion->prepare($query);
        $statement->execute();

        // Obtener todas las preguntas
        $preguntas = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Modificar la estructura de las preguntas
        $preguntasConRespuestas = [];
        foreach ($preguntas as $pregunta) {
            $preguntaConRespuesta = [
                'id' => $pregunta['id'],
                'enunciado' => $pregunta['enunciado'],
                'respuesta' => [
                    'res1' => $pregunta['respuesta1'],
                    'res2' => $pregunta['respuesta2'],
                    'res3' => $pregunta['respuesta3']
                ]
            ];
            $preguntasConRespuestas[] = $preguntaConRespuesta;
        }

        // Verificar si se encontraron preguntas
        if ($preguntasConRespuestas) {
            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['pregunta' => $preguntasConRespuestas]);
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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
}



/* elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
}
 */