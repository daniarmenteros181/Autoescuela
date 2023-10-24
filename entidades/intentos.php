<?php

class Intento {
    private $id;
    private $fecha;
    private $jsonIntento;
    private $idUsuario;
    private $idExamen;

    public function __construct($id, $fecha, $jsonIntento, $idUsuario, $idExamen) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->jsonIntento = $jsonIntento;
        $this->idUsuario = $idUsuario;
        $this->idExamen = $idExamen;
    }

    public function getId() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getJsonIntento() {
        return $this->jsonIntento;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdExamen() {
        return $this->idExamen;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setJsonIntento($jsonIntento) {
        $this->jsonIntento = $jsonIntento;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setIdExamen($idExamen) {
        $this->idExamen = $idExamen;
    }
}



?>