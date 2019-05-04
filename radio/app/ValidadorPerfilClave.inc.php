<?php

include_once 'RepositorioUsuario.inc.php';

class ValidadorPerfilClave {

    private $aviso_inicio;
    private $aviso_cierre;
    
    private $clave;
 
    private $error_clave1;
    private $error_clave2;

    public function __construct($clave1, $clave2, $conexion) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' rol='alert'>";
        $this->aviso_cierre = "</div>";
        
        $this -> clave = "";
        
        $this -> error_clave1 = $this -> validar_clave1 ($clave1);
        $this -> error_clave2 = $this -> validar_clave2 ($clave1, $clave2);
    
        if (($this -> error_clave1 === "") && ($this -> error_clave2 === "")) {
            $this -> clave = $clave1;
        }
    }   
    
    private function variable_iniciada($variable){
        if(isset($variable) && !empty($variable) && $variable !==" "){
            return true;
        } else {
            return false;
        }
    }
    
    private function validar_clave1($clave1) {
        if (!$this -> variable_iniciada($clave1)) {
            return "Debes escribír una contraseña.";
        }
        
        return "";
    }
    
    private function validar_clave2($clave1, $clave2) {
        if (!$this -> variable_iniciada($clave1)) {
            return "Primero debes rellenar la contraseña.";
        }
        
        if (!$this -> variable_iniciada($clave2)) {
            return "Debes repetir tu contraseña.";
        }
        
        if ($clave1 !== $clave2) {
            return "Ambas contraseñas deben coincidir.";
        }
        
        return "";
    }
     
    public function obtener_clave() {
        return $this -> clave;
    }
    
    public function obtener_error_clave1() {
        return $this -> error_clave1;
    }
    
    public function obtener_error_clave2() {
        return $this -> error_clave2;
    }

    
    public function mostrar_error_clave1() {
        if ($this -> error_clave1 !== "") {
            echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2() {
        if ($this -> error_clave2 !== "") {
            echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
        }
    }
    
    public function clave_valido() {
        if ($this -> error_clave1 === "" &&
                $this -> error_clave2 === "") {
            
            return true;
        } else {
            return false;
        }
    }
}