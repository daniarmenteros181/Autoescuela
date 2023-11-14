<?php

require_once "db.php";

class examenRepositorio {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Crear un examen
    public function insertarExamen($fechaHora, $fechaFin, $idUsuario) {
        $sql = "INSERT INTO examen (fechaHora, fechaFin, idUsuario) VALUES (:fechaHora, :fechaFin, :idUsuario)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':fechaHora', $fechaHora);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':idUsuario', $idUsuario);

        return $stmt->execute();
    }

    // Actualizar un examen
    public function actualizarExamen($id, $fechaHora, $fechaFin, $idUsuario) {
        $sql = "UPDATE examen SET fechaHora = :fechaHora, fechaFin = :fechaFin, idUsuario = :idUsuario WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fechaHora', $fechaHora);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':idUsuario', $idUsuario);

        return $stmt->execute();
    }

    // Borrar un examen
    public function borrarExamen($id) {
        $sql = "DELETE FROM examen WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

?>