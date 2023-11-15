<?php


class leerPreguntas{

public static function llamada(){

$nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
   echo "¡Bienvenido, $nombreUsuario!";
   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);

   self::leerPreguntaEnBaseDeDatos();


} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";
   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}

// Puedes agregar más contenido y funcionalidad aquí que solo los usuarios logueados puedan ver.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["crearPregunta"])) {
    // Llamada a la función para insertar en la base de datos
    self::leerPreguntaEnBaseDeDatos();
}
}
}

// Función para insertar la pregunta en la base de datos
public static function leerPreguntaEnBaseDeDatos() {
   

    try {
        $conexion = db::entrar();

         // Preparar la consulta SQL utilizando sentencias preparadas
         $sql = "SELECT * FROM pregunta";

         $stmt = $conexion->prepare($sql);

         // Ejecutar la consulta
         $stmt->execute();

         // Obtener todas las filas resultantes
         $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

         // Mostrar las preguntas
         echo "<h2>Preguntas:</h2>";
         foreach ($preguntas as $pregunta) {
             echo "<p>Enunciado: " . $pregunta['enunciado'] . "</p>";
             // Mostrar otros campos según sea necesario
         }
     } catch (PDOException $e) {
         echo "Error al leer las preguntas: " . $e->getMessage();
     }
 }
}

leerPreguntas::llamada();



?>


<!DOCTYPE html>
<html>
<head>
    <title>Crear Pregunta</title>
<!--     <link rel="stylesheet" type="text/css" href="../estilos/estilosMenu.css">
 -->
</head>
<body>
       
 <form id="crearPreguntaForm" action="" method="post">


        
    
    <input type="submit" value="out" name="out">

    <a href="?menu=crearPreg">Crear Preguntas</a>



    </form>


</body>
</html>
