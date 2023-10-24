<?php

class ExamenPregunta {
    private $id;
    private $idPregunta;
    private $idExamen;

    public function __construct($id, $idPregunta, $idExamen) {
        $this->id = $id;
        $this->idPregunta = $idPregunta;
        $this->idExamen = $idExamen;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdPregunta() {
        return $this->idPregunta;
    }

    public function getIdExamen() {
        return $this->idExamen;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

    public function setIdExamen($idExamen) {
        $this->idExamen = $idExamen;
    }
}


?>