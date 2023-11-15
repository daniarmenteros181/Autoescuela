<?php
/* if ($_SERVER['REQUEST_METHOD']=='POST')
{

} */
header( "Access-Control-Allow-Origin: *" );


require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta




   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
    } else {
        // Si no se proporciona el parámetro 'id_examen'
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'Se requiere el parámetro "id_examen" en la solicitud'));
    }
} else {
    // Método no permitido
    echo json_encode(['error' => 'Método no permitido']);
}  
 

 /*  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
}   */


/* elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{

}
elseif ($_SERVER['REQUEST_METHOD']=='PUT')
{
    
} */
