<?php

require_once "db.php";

class preguntaRepositorio {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Crear una pregunta
    public function insertarPregunta($enunciado, $respuesta1, $respuesta2, $respuesta3, $correcta, $url, $tipoUrl, $idDificultad, $idCategoria) {
        $sql = "INSERT INTO pregunta (enunciado, respuesta1, respuesta2, respuesta3, correcta, url, tipoUrl, idDificultad, idCategoria) VALUES (:enunciado, :respuesta1, :respuesta2, :respuesta3, :correcta, :url, :tipoUrl, :idDificultad, :idCategoria)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':enunciado', $enunciado);
        $stmt->bindParam(':respuesta1', $respuesta1);
        $stmt->bindParam(':respuesta2', $respuesta2);
        $stmt->bindParam(':respuesta3', $respuesta3);
        $stmt->bindParam(':correcta', $correcta);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':tipoUrl', $tipoUrl);
        $stmt->bindParam(':idDificultad', $idDificultad);
        $stmt->bindParam(':idCategoria', $idCategoria);

        return $stmt->execute();
    }

    // Actualizar una pregunta
    public function actualizarPregunta($id, $enunciado, $respuesta1, $respuesta2, $respuesta3, $correcta, $url, $tipoUrl, $idDificultad, $idCategoria) {
        $sql = "UPDATE pregunta SET enunciado = :enunciado, respuesta1 = :respuesta1, respuesta2 = :respuesta2, respuesta3 = :respuesta3, correcta = :correcta, url = :url, tipoUrl = :tipoUrl, idDificultad = :idDificultad, idCategoria = :idCategoria WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':enunciado', $enunciado);
        $stmt->bindParam(':respuesta1', $respuesta1);
        $stmt->bindParam(':respuesta2', $respuesta2);
        $stmt->bindParam(':respuesta3', $respuesta3);
        $stmt->bindParam(':correcta', $correcta);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':tipoUrl', $tipoUrl);
        $stmt->bindParam(':idDificultad', $idDificultad);
        $stmt->bindParam(':idCategoria', $idCategoria);

        return $stmt->execute();
    }

    // Borrar una pregunta
    public function borrarPregunta($id) {
        $sql = "DELETE FROM pregunta WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

?>