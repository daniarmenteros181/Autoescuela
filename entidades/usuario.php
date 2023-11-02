<?php

class Usuario {
    public $id;
    public $nombre;
    public $contrasenia;
    public $rol;

/*
    public function __constructt($nombre, $contrasenia) {
        $this->nombre = $nombre;
        $this->contrasenia = $contrasenia;
    }
    
    public function __construct($id, $nombre, $contrasenia, $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contrasenia = $contrasenia;
        $this->rol = $rol;
    }
    */
    public function __construct($id = null, $nombre = null, $contrasenia = null, $rol = null) {
        if ($id !== null && $nombre !== null && $contrasenia !== null && $rol !== null) {
            // Constructor con todos los parámetros
            $this->id = $id;
            $this->nombre = $nombre;
            $this->contrasenia = $contrasenia;
            $this->rol = $rol;
        } elseif ($nombre !== null && $contrasenia !== null) {
            // Constructor con solo nombre y contraseña
            $this->nombre = $nombre;
            $this->contrasenia = $contrasenia;
        } else {
            // Otro constructor o manejo de errores, según tus necesidades
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
}


?>