<?php
class crearExamen{

public static function llamada(){
    
     mostrarMenu::mostrarMenuAdmin();
 
    $nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.
    sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);

} else {
    // El usuario no está logueado, muestra un mensaje o redirige a la página de inicio de sesión.
    echo "mal, usuario!";
   header('Location: http://autoescueladaniels.com/formularios/recuperarContrasenia.php?');

}
// Puedes agregar más contenido y funcionalidad aquí que solo los usuarios logueados puedan ver.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crearExamen"])) {
        // Obtén el id del usuario seleccionado del formulario
        $idUser = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;
    
        // Llamada a la función para insertar en la base de datos
        $idExamen = self::crearExamenEnBaseDeDatos($idUser);
    
        // Procesa las preguntas seleccionadas
        if (isset($_POST['preguntas_seleccionadas'])) {
            $preguntasSeleccionadas = $_POST['preguntas_seleccionadas'];
    
            foreach ($preguntasSeleccionadas as $idPregunta) {
                // Llamada a la función para asignar preguntas al examen
                self::asignarPreguntaAExamen($idPregunta, $idExamen);
            }
    
            echo "Examen creado y preguntas asignadas correctamente";
        } else {
            echo "Examen creado pero no se seleccionaron preguntas";
        }
    }
    
}

}



public static function crearExamenEnBaseDeDatos($idUser) {
   

    try {
        $conexion = db::entrar();

        // Inserta un nuevo examen
        $sqlInsertExamen = "INSERT INTO examen (fechaHora, fechaFin, id_User) VALUES (NOW(), NOW() + INTERVAL 1 HOUR, :idUser)";
        $stmtInsertExamen = $conexion->prepare($sqlInsertExamen);

        $stmtInsertExamen->bindParam(':idUser', $idUser);
        $stmtInsertExamen->execute();

        // Obtén el ID del examen recién insertado
        
        $idExamen = $conexion->lastInsertId();

        echo "Examen creado correctamente";
        return $idExamen;

    } catch (PDOException $e) {
        echo "Error al crear el examen: " . $e->getMessage();
    }
}


// Función para asignar una pregunta a un examen en la base de datos
public static function asignarPreguntaAExamen($idExamen,$idPregunta) {
    try {
        $conexion = db::entrar();

        // Inserta la relación entre la pregunta y el examen
        $sqlInsertRelacion = "INSERT INTO examen_pregunta (id_Pregunta,id_Examen ) VALUES (:idExamen, :idPregunta)";
        $stmtInsertRelacion = $conexion->prepare($sqlInsertRelacion);
       
        $stmtInsertRelacion->bindParam(':idPregunta', $idPregunta);
        $stmtInsertRelacion->bindParam(':idExamen', $idExamen);
        $stmtInsertRelacion->execute();

        echo "Pregunta asignada al examen correctamente";
    } catch (PDOException $e) {
        echo "Error al asignar la pregunta al examen: " . $e->getMessage();
    }
}


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

         echo "<div class='preguntas-container'>";
        echo "<h2 class='preguntas-titulo'>Preguntas:</h2>";

        echo "<form id='seleccionarPreguntasForm' action='' method='post'>";

        foreach ($preguntas as $pregunta) {
        echo "<div class='pregunta'>";
        echo "<p class='enunciado'>" . nl2br($pregunta['enunciado']) . "</p>";
        echo "<input type='checkbox' name='preguntas_seleccionadas[]' value='{$pregunta['id']}' />";

        

        echo "</div>";
        }
        echo "<button type='button' onclick='marcarTodas()'>Marcar Todas</button>";
        echo "<button type='button' onclick='desmarcarTodas()'>Desmarcar Todas</button>";

        echo "<button type='submit' name='borrarPreguntas'>Borrar Preguntas Seleccionadas</button>";

        echo "</div>";
     } catch (PDOException $e) {
         echo "Error al leer las preguntas: " . $e->getMessage();
     }
 }

 public static function obtenerListaDeUsuarios() {
    try {
        $conexion = db::entrar();

        // Preparar la consulta SQL utilizando sentencias preparadas
        $sql = "SELECT id, nombre FROM usuario";

        $stmt = $conexion->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener todas las filas resultantes
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener la lista de usuarios: " . $e->getMessage();
        return [];
    }
}
 

}

crearExamen::llamada();



?>
<script>
    function marcarTodas() {
        var checkboxes = document.querySelectorAll('input[name="preguntas_seleccionadas[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true;
        });
    }

    function desmarcarTodas() {
        var checkboxes = document.querySelectorAll('input[name="preguntas_seleccionadas[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    }
</script>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Examen</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilosPreguntas.css">

</head>
<body>

<div class="pregunta-container">
<form id="crearExamenForm" action="" method="post">
    <?php
    // Obtén las preguntas de la base de datos
    $preguntas = crearExamen::leerPreguntaEnBaseDeDatos();

    // Obtén la lista de usuarios
    $usuarios = crearExamen::obtenerListaDeUsuarios(); // Debes implementar esta función

    echo '<label for="selectUsuario">Seleccionar Usuario:</label>';
    echo '<select id="selectUsuario" name="idUsuario">';
    foreach ($usuarios as $usuario) {
        echo '<option value="' . $usuario['id'] . '">' . $usuario['nombre'] . '</option>';
    }
    echo '</select><br>';
    ?>
    <input type="submit" value="Crear Examen" name="crearExamen">
    <input type="submit" value="out" name="out">
</form>




</div>

</body>
</html>

