<?php

class Carrusel {

    private $id;
    private $titulo;
    private $texto;

    public function __construct($id, $titulo, $texto) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->texto = $texto;
    }

    public function obtener_id() {
        return $this->id;
    }

    public function obtener_titulo() {
        return $this->titulo;
    }

    public function obtener_texto() {
        return $this->texto;
    }
}