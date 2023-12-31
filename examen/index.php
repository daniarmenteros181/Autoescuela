<?php

class ind{

    public static function mostrarFormulario(){


    if (funcionesLogin::estarLogeado()) {
        mostrarMenu::mostrarMenuAlumno();
        ind::leerExamenes();
        


    } else {
        // El usuario no está logueado, redirige a la página de inicio de recuperar contraseña.
        header('Location: ?menu=olvido');

    }
    //Si se presiona el boton de out, cierra la sesion y te lleva al inicio
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica si se presionó el botón "borrar"
    if (isset($_POST["out"])) {
       
       sesion::cierraSesion();
       header('Location: ?menu=login');
       
    
   }
   }

       
    }

    //Funcion para leer examenes 
    public static function leerExamenes(){
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

    //Funcion que genera formulario 
    public static function generarFormulario($examenes)
    {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Seleccionar Examen</title>
            <script src="js/autoescuela.js"></script>
            <link rel="stylesheet" href="../estilos/estilosExamen.css">

        </head>
        <body>
            <h1 id="tit">Seleccion de Examen</h1>
            <form id="formularioExamenes">
            <div id="examen"></div>

                <label id="selc">Seleccione un examen:</label>
                <select id="chec"  name="examen" required>
                    <?php foreach ($examenes as $examen) : ?>
                        <option  value="<?= $examen['id'] ?>">
                            <?= 'ID: ' . $examen['id']  ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <br>
                <input type="submit"id="comenzar" value="Comenzar Examen">

            </form>

            
        </body>
        </html>
        <?php
    }
}
// Llamar a la función para mostrar el formulario
ind::mostrarFormulario();

?>