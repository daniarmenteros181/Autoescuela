<?php

class Examen {
    private $id;
    private $fechaHora;
    private $fechaFin;
    private $idUsuario;

    public function __construct($id, $fechaHora, $fechaFin, $idUsuario) {
        $this->id = $id;
        $this->fechaHora = $fechaHora;
        $this->fechaFin = $fechaFin;
        $this->idUsuario = $idUsuario;
    }

    public function getId() {
        return $this->id;
    }

    public function getFechaHora() {
        return $this->fechaHora;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
}

?>