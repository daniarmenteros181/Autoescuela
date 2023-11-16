<?php


class crearPregunta{

public static function llamada(){

    mostrarMenu::mostrarMenuAdmin();



$nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
/*    echo "¡Bienvenido, $nombreUsuario!";
 */   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);

} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";
   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}

// Puedes agregar más contenido y funcionalidad aquí que solo los usuarios logueados puedan ver.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["crearPregunta"])) {
    // Llamada a la función para insertar en la base de datos
    self::insertarPreguntaEnBaseDeDatos();
}

    // Verifica si se presionó el botón "borrar"
    if (isset($_POST["out"])) {
        sesion::cierraSesion();
        header('Location: ?menu=login');
    }
}
}

// Función para insertar la pregunta en la base de datos
public static function insertarPreguntaEnBaseDeDatos() {
    $enunciado = $_POST["enunciado"];
    $respuesta1 = $_POST["respuesta1"];
    $respuesta2 = $_POST["respuesta2"];
    $respuesta3 = $_POST["respuesta3"];
    $respuestaCorrec = $_POST["respuestaCorrec"];
    $url = $_POST["url"];
    $tipo_url = $_POST["tipo_url"]; 
    $dificultad = $_POST["dificultad"];
    $categoria = $_POST["categoria"];

    try {
        $conexion = db::entrar();

        // Preparar la consulta SQL utilizando sentencias preparadas
        $sql = "INSERT INTO pregunta (enunciado, respuesta1, respuesta2, respuesta3, correcta, url,tipo_url, id_dificultad, id_categoria)
                VALUES (:enunciado, :respuesta1, :respuesta2, :respuesta3, :respuestaCorrec, :url,:tipo_url, :dificultad, :categoria)";




        $stmt = $conexion->prepare($sql);

        // Bindear los parámetros
        $stmt->bindParam(':enunciado', $enunciado);
        $stmt->bindParam(':respuesta1', $respuesta1);
        $stmt->bindParam(':respuesta2', $respuesta2);
        $stmt->bindParam(':respuesta3', $respuesta3);
        $stmt->bindParam(':respuestaCorrec', $respuestaCorrec);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':tipo_url', $tipo_url);
        $stmt->bindParam(':dificultad', $dificultad);
        $stmt->bindParam(':categoria', $categoria);

        // Ejecutar la consulta
        $stmt->execute();

        echo "Pregunta creada correctamente";
    } catch (PDOException $e) {
        echo "Error al crear la pregunta: " . $e->getMessage();
    }
}
}

crearPregunta::llamada();



?>


<!DOCTYPE html>
<html>
<head>
    <title>Crear Pregunta</title>
      <link rel="stylesheet" type="text/css" href="../estilos/estilosPreguntas.css">
 
     
</head>
<body>
    
<div class="pregunta-container">


 <form id="crearPreguntaForm" action="" method="post">

        <label for="enunciado">Enunciado:</label>
        <textarea id="enunciado" name="enunciado" required></textarea><br>

        <label for="respuesta1">Respuesta 1:</label>
        <input type="text" id="respuesta1" name="respuesta1" required><br>

        <label for="respuesta2">Respuesta 2:</label>
        <input type="text" id="respuesta2" name="respuesta2" required><br>

        <label for="respuesta3">Respuesta 3:</label>
        <input type="text" id="respuesta3" name="respuesta3" required><br>

        <label for="respuestaCorrec">Respuesta Correcta:</label>
        <input type="text" id="respuestaCorrec" name="respuestaCorrec" required><br>

        <label for="url">Url :</label>
        <input type="text" id="url" name="url" required><br>

        <label for="tipo_url">Tipo Url :</label>
        <input type="text" id="tipo_url" name="tipo_url" required><br>

        <label for="dificultad">Dificultad :</label>
        <input type="text" id="dificultad" name="dificultad" required><br>
        
        <label for="categoria">Categoria :</label>
        <input type="text" id="categoria" name="categoria" required><br>

        <input type="submit" value="Crear Pregunta" name="crearPregunta">

        <a href="?menu=leerPreg">Leer Preguntas</a>

    </form>
    </div>


</body>
</html>
