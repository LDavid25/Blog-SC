<?php

include_once 'RepositorioUsuario.inc.php';

class ValidadorPerfilNombre {

    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;  
    private $error_nombre;

    public function __construct($nombre, $conexion) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' rol='alert'>";
        $this->aviso_cierre = "</div>";
        
        $this -> nombre = "";
        
        $this -> error_nombre = $this -> validar_nombre ($conexion, $nombre);
    }   
    
    private function variable_iniciada($variable){
        if(isset($variable) && !empty($variable) && $variable !==" "){
            return true;
        } else {
            return false;
        }
    }
    
    private function validar_nombre($conexion, $nombre){
        if(!$this -> variable_iniciada($nombre)){
            return "Debes escribir un nombre";
        } else {
            $this -> nombre = $nombre;
        }
        
        if (strlen($nombre) < 4) {
            return "El nombre debe ser mayor a 4 caracteres.";
        }
        
        if (strlen($nombre) > 24) {
            return "El nombre no puede ocupar más de 24 caracteres.";
        }
        
        return "";
    }

    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_error_nombre() {
        return $this -> error_nombre;
    }

    public function mostrar_nombre() {
        if ($this -> nombre !== "") {
            echo 'value="'. $this -> nombre . '"';
        }
    }
    
    public function mostrar_error_nombre() {
        if ($this -> error_nombre !== "") {
            echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
        }
    }
   
    public function nombre_valido() {
        if ($this -> error_nombre === "") {
            
            return true;
        } else {
            return false;
        }
    }
}