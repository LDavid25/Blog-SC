<?php 
include_once 'RepositorioUsuario.inc.php';

class ValidadorLogin {
    private $usuario;
    private $error;
    
    public function __construct($email, $clave, $conexion) {
        $this -> error = "";
        
        if(!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)){
            $this->usuario = null;
            $this->error = "Debes introducir tus datos";
        } else{
            $this->usuario = RepositorioUsuario::obtener_usuario_email($email, $conexion);
            
            if(is_null($this->usuario) || !password_verify($clave, $this->usuario->obtener_password())){
                $this->error = "Email o Contraseña incorrectos";
            } else
            if($this->usuario->obtener_activo() == '1'){
                $this->error = "Este Usuario esta deshabilitado, Contacte a los administradores";
            }
        }
    }
    
    private function variable_iniciada($variable){
        if(isset($variable) && !empty($variable)){
            return true;
        } else {
            return false;
        }
    }
    
    public function obtener_usuario(){
        return $this -> usuario;
    }
    
    public function obtener_error(){
        return $this -> error;
    }
    public function mostrar_error(){
        if($this -> error !== ""){
            echo "<div class='alert alert-danger' rol='alert'><strong>";
            echo $this -> error;
            echo '</strong></div>';
        }
    }
    
}
