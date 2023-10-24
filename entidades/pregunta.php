<?php

class Pregunta {

    private $id;
    private $enunciado;
    private $respuesta1;
    private $respuesta2;
    private $respuesta3;
    private $correcta;
    private $url;
    private $tipoUrl;
    private $idDificultad;
    private $idCategoria;

    public function __construct($id, $enunciado, $respuesta1, $respuesta2, $respuesta3, $correcta, $url, $tipoUrl, $idDificultad, $idCategoria) {
        $this->id = $id;
        $this->enunciado = $enunciado;
        $this->respuesta1 = $respuesta1;
        $this->respuesta2 = $respuesta2;
        $this->respuesta3 = $respuesta3;
        $this->correcta = $correcta;
        $this->url = $url;
        $this->tipoUrl = $tipoUrl;
        $this->idDificultad = $idDificultad;
        $this->idCategoria = $idCategoria;
    }

    public function getId() {
        return $this->id;
    }

    public function getEnunciado() {
        return $this->enunciado;
    }

    public function getRespuesta1() {
        return $this->respuesta1;
    }

    public function getRespuesta2() {
        return $this->respuesta2;
    }

    public function getRespuesta3() {
        return $this->respuesta3;
    }

    public function getCorrecta() {
        return $this->correcta;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getTipoUrl() {
        return $this->tipoUrl;
    }

    public function getIdDificultad() {
        return $this->idDificultad;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEnunciado($enunciado) {
        $this->enunciado = $enunciado;
    }

    public function setRespuesta1($respuesta1) {
        $this->respuesta1 = $respuesta1;
    }

    public function setRespuesta2($respuesta2) {
        $this->respuesta2 = $respuesta2;
    }

    public function setRespuesta3($respuesta3) {
        $this->respuesta3 = $respuesta3;
    }

    public function setCorrecta($correcta) {
        $this->correcta = $correcta;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setTipoUrl($tipoUrl) {
        $this->tipoUrl = $tipoUrl;
    }

    public function setIdDificultad($idDificultad) {
        $this->idDificultad = $idDificultad;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }
}

?>