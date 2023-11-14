<?php
header( "Access-Control-Allow-Origin: *" );

require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta


if ($_SERVER['REQUEST_METHOD']=='POST')
{
    // Obtener los datos del cuerpo de la solicitud
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json, true);

    // Verificar si los datos necesarios están presentes
    if (isset($datos['nombre']) && isset($datos['rol'])) {
        try {
            $conexion = db::entrar();

            // Preparar la consulta para insertar un nuevo usuario
            $query = "INSERT INTO usuario (nombre, rol) VALUES (:nombre, :rol)";
            $statement = $conexion->prepare($query);

            // Vincular parámetros
            $statement->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $statement->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);

            // Ejecutar la consulta
            $statement->execute();

            // Obtener el ID del nuevo usuario
            $nuevoUsuarioID = $conexion->lastInsertId();

            // Devolver una respuesta con el ID del nuevo usuario
            header('Content-type: application/json');
            echo json_encode(array('id' => $nuevoUsuarioID));

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


// Obtener los datos del usuario desde la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    //$id = 3; // Esto podría ser obtenido de $_GET['id'] después de validar y sanitizar
    $id = isset($_GET['id']) ? intval($_GET['id']) : 5;//garantiza que $id será un número entero.


    try {
        $conexion = db::entrar();
        $query = "SELECT id, nombre, rol FROM usuario WHERE id = :id";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode($usuario);
        } else {
            // Si no se encuentra el usuario, puedes manejarlo de acuerdo a tus necesidades
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'Usuario no encontrado'));
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
}

//Para borrar
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{
     // Obtener el ID del usuario a eliminar
     $id = isset($_GET['id']) ? intval($_GET['id']) : 0;//Aqui poner el id del usuario que queremos eliminar 

     if ($id > 0) {
         try {
             $conexion = db::entrar();
 
             // Preparar la consulta para eliminar al usuario
             $query = "DELETE FROM usuario WHERE id = :id";
             $statement = $conexion->prepare($query);
             $statement->bindParam(':id', $id, PDO::PARAM_INT);
 
             // Ejecutar la consulta
             $statement->execute();
 
             // Verificar si se eliminó algún usuario
             $filas_afectadas = $statement->rowCount();
             if ($filas_afectadas > 0) {
                 // Devolver una respuesta exitosa
                 header('Content-type: application/json');
                 echo json_encode(array('mensaje' => 'Usuario eliminado exitosamente'));
             } else {
                 // Si no se encuentra el usuario, puedes manejarlo de acuerdo a tus necesidades
                 header('HTTP/1.0 404 Not Found');
                 echo json_encode(array('error' => 'Usuario no encontrado'));
             }
         } catch (PDOException $e) {
             // Manejar errores de la base de datos según tus necesidades
             header('HTTP/1.1 500 Internal Server Error');
             echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
         }
     } else {
         // ID no válido, devolver un mensaje de error
         header('HTTP/1.0 400 Bad Request');
         echo json_encode(array('error' => 'ID de usuario no válido'));
     }
 }


 //Para actualizar
/* if ($_SERVER['REQUEST_METHOD']=='PUT')
{
    // Obtener los datos del cuerpo de la solicitud
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json, true);

    // Verificar si los datos necesarios están presentes
    if (isset($datos['id']) && isset($datos['nombre']) && isset($datos['rol'])) {
        try {
            $conexion = db::entrar();

            // Preparar la consulta para actualizar al usuario
            $query = "UPDATE usuario SET nombre = :nombre, rol = :rol WHERE id = :id";
            $statement = $conexion->prepare($query);

            // Vincular parámetros
            $statement->bindParam(':id', $datos['id'], PDO::PARAM_INT);
            $statement->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $statement->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);

            // Ejecutar la consulta
            $statement->execute();

            // Verificar si se actualizó algún usuario
            $filas_afectadas = $statement->rowCount();
            if ($filas_afectadas > 0) {
                // Devolver una respuesta exitosa
                header('Content-type: application/json');
                echo json_encode(array('mensaje' => 'Usuario actualizado exitosamente'));
            } else {
                // Si no se encuentra el usuario, puedes manejarlo de acuerdo a tus necesidades
                header('HTTP/1.0 404 Not Found');
                echo json_encode(array('error' => 'Usuario no encontrado'));
            }
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
 */


//Este con objeto stdClass en lugar de un array asociativo 
 if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener los datos del cuerpo de la solicitud
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json);

    // Verificar si los datos necesarios están presentes
    if (isset($datos->id) && isset($datos->nombre) && isset($datos->rol)) {
        try {
            $conexion = db::entrar();

            // Preparar la consulta para actualizar al usuario
            $query = "UPDATE usuario SET nombre = :nombre, rol = :rol WHERE id = :id";
            $statement = $conexion->prepare($query);

            // Vincular parámetros
            $statement->bindParam(':id', $datos->id, PDO::PARAM_INT);
            $statement->bindParam(':nombre', $datos->nombre, PDO::PARAM_STR);
            $statement->bindParam(':rol', $datos->rol, PDO::PARAM_STR);

            // Ejecutar la consulta
            $statement->execute();

            // Verificar si se actualizó algún usuario
            $filas_afectadas = $statement->rowCount();
            if ($filas_afectadas > 0) {
                // Devolver una respuesta exitosa
                header('Content-type: application/json');
                echo json_encode(array('mensaje' => 'Usuario actualizado exitosamente'));
            } else {
                // Si no se encuentra el usuario, puedes manejarlo de acuerdo a tus necesidades
                header('HTTP/1.0 404 Not Found');
                echo json_encode(array('error' => 'Usuario no encontrado'));
            }
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
 
 
