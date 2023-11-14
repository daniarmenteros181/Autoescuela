<?php

require_once "db.php";

class categoriaRepositorio {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Crear una categoría
    public function insertarCategoria($nombre) {
        $sql = "INSERT INTO categoria (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);

        return $stmt->execute();
    }

    // Actualizar una categoría
    public function actualizarCategoria($id, $nombre) {
        $sql = "UPDATE categoria SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);

        return $stmt->execute();
    }

    // Borrar una categoría
    public function borrarCategoria($id) {
        $sql = "DELETE FROM categoria WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

?>
