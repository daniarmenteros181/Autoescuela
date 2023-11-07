<?php

require_once "db.php";

class usuarioRepositorio{

    private $conexion;

    public  function __construct($conexion) {
        $this->conexion = $conexion;
    }

    //Crear un usuario
    public function insertarUsuario($nombre, $contrasenia) {
        $sql = "INSERT INTO usuario (nombre, contrasenia) VALUES (:nombre, :contrasenia)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contrasenia', $contrasenia);

        return $stmt->execute();
    }

    //Actualizar un usuario
    public function actualizarUsuario($id, $nombre, $contrasenia, $rol) {
        $sql = "UPDATE usuario SET nombre = :nombre, contrasenia = :contrasenia, rol = :rol WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contrasenia', $contrasenia);
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }

    //Borrar un usuario
    public function borrarUsuario($id) {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Actualizar usuario sin rol
    public function actualizarUsuariosSinRol($nuevoRol) {
    $sql = "UPDATE usuario SET rol = :nuevoRol WHERE rol = ''";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':nuevoRol', $nuevoRol);

    $stmt->execute();

    return $stmt->rowCount();
}



}




?>