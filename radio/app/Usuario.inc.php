<?php

class Usuario {

    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fecha_registro;
    private $tipo;
    private $activo;
    
    public function __construct ($id, $nombre, $email, $password, $fecha_registro, $tipo, $activo) {
        $this-> id = $id;
        $this-> nombre = $nombre;
        $this-> email = $email;
        $this-> password = $password;
        $this-> fecha_registro = $fecha_registro;
        $this-> tipo = $tipo;
        $this-> activo = $activo;
    }

    public function obtener_id() {
        return $this->id;
    }
    
    public function obtener_nombre() {
        return $this->nombre;
    }

    public function obtener_email() {
        return $this->email;
    }

    public function obtener_password() {
        return $this->password;
    }

    public function obtener_fecha_registro() {
        return $this->fecha_registro;
    }

    public function obtener_tipo() {
        return $this->tipo;
    }

    public function obtener_activo() {
        return $this->activo;
    }

  
    
    //METODOS SET
    public function cambiar_nombre($nombre) {
        return $this->nombre = $nombre;
    }

    public function cambiar_email($email) {
        return $this->email = $email;
    }

    public function cambiar_password($password) {
        return $this->password = $password;
    }

    public function cambiar_tipo($tipo) {
        return $this->tipo = $tipo;
    }

    public function cambiar_activo($activo) {
        return $this->activo = $activo;
    }
}