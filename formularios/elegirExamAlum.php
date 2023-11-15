<?php
class FormularioExamenes{
    public static function mostrarFormulario()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Obtener la conexión a la base de datos utilizando la clase db
            $conexion = db::entrar();

            // Preparar y ejecutar la consulta para obtener todos los exámenes
            $query = "SELECT id, fechaHora, fechaFin FROM examen";

            $statement = $conexion->query($query);

            // Obtener todos los exámenes
            $examenes = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Verificar si se encontraron exámenes
            if ($examenes) {
                self::generarFormulario($examenes);
            } else {
                // Si no se encuentran exámenes, puedes manejarlo según tus necesidades
                echo 'No se encontraron exámenes.';
            }
        } else {
            // Método no permitido
            echo 'Método no permitido.';
        }
    }

    private static function generarFormulario($examenes)
    {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Seleccionar Examen</title>
        </head>
        <body>
            <h1>Selecciona un Examen</h1>
            <form id="formularioExamenes">
                <label for="examen">Seleccione un examen:</label>
                <select id="examen" name="examen" required>
                    <?php foreach ($examenes as $examen) : ?>
                        <option value="<?= $examen['id'] ?>">
                            <?= 'ID: ' . $examen['id']  ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <br>
                <input type="submit" value="Comenzar Examen">
            </form>

            <script>
                document.getElementById("formularioExamenes").addEventListener("submit", function (event) {
                    event.preventDefault();
                    var seleccion = document.getElementById("examen");
                    var idExamen = seleccion.options[seleccion.selectedIndex].value;
                    // Redirigir o realizar otras acciones con el ID del examen seleccionado
                    alert("Has seleccionado el examen con ID: " + idExamen);
                    // Puedes redirigir a otra página con window.location.href o enviar el ID a través de una solicitud AJAX
                });
            </script>
        </body>
        </html>
        <?php
    }
}

// Llamar a la función para mostrar el formulario
FormularioExamenes::mostrarFormulario();
?>
