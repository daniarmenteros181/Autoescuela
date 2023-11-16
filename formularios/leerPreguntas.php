<?php


class leerPreguntas{
    

public static function llamada(){

    mostrarMenu::mostrarMenuAdmin();

$nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
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

    // Verifica si se presionó el botón "borrar"
    if (isset($_POST["out"])) {
       
       sesion::cierraSesion();
   
       header('Location: ?menu=login');
       
    
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

        /*  // Mostrar las preguntas
         echo "<h2>Preguntas:</h2>";
         foreach ($preguntas as $pregunta) {
             echo "<p>Enunciado: " . $pregunta['enunciado'] . "</p>";
             // Mostrar otros campos según sea necesario
         } */
         echo "<div class='preguntas-container'>";
        echo "<h2 class='preguntas-titulo'>Preguntas:</h2>";

        foreach ($preguntas as $pregunta) {
        echo "<div class='pregunta'>";
        echo "<p class='enunciado'>" . nl2br($pregunta['enunciado']) . "</p>";
        // Otros campos y clases según sea necesario
        echo "</div>";
        }

        echo "</div>";
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
     <link rel="stylesheet" type="text/css" href="../estilos/estilosPreguntas.css">
 </head>
<body>
       
 <form id="crearPreguntaForm" action="" method="post">




    </form>


</body>
</html>
