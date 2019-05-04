<?php

class Entradas{
    
    private $id;
    private $autor_id;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activo;
    
    public function __construct($id, $autor_id, $url, $titulo, $texto, $fecha, $activo) {
        $this -> id = $id;
        $this -> autor_id = $autor_id;
        $this -> url = $url;
        $this -> titulo = $titulo;
        $this -> texto = $texto;
        $this -> fecha = $fecha;
        $this -> activo = $activo;
    }
    
    public function obtener_id() {
        return $this->id;
    }

    public function obtener_autor_id() {
        return $this->autor_id;
    }

    public function obtener_url() {
        return $this->url;
    }

    public function obtener_titulo() {
        return $this->titulo;
    }

    public function obtener_texto() {
        return $this->texto;
    }

    public function obtener_fecha() {
        return $this->fecha;
    }

    public function obtener_activo() {
        return $this->activo;
    }

    

//METODOS SET
    public function cambiar_titulo($titulo) {
        $this->titulo = $titulo;
    }

    public function cambiar_texto($texto) {
        $this->texto = $texto;
    }

    public function cambiar_activo($activo) {
        $this->activo = $activo;
    }
}
