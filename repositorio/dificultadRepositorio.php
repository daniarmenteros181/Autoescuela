<?php

require_once "db.php";

class dificultadRepositorio {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Crear una dificultad
    public function insertarDificultad($nombre) {
        $sql = "INSERT INTO dificultad (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);

        return $stmt->execute();
    }

    // Actualizar una dificultad
    public function actualizarDificultad($id, $nombre) {
        $sql = "UPDATE dificultad SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);

        return $stmt->execute();
    }

    // Borrar una dificultad
    public function borrarDificultad($id) {
        $sql = "DELETE FROM dificultad WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

?>


