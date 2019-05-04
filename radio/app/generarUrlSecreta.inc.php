<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioRecuperarClave.inc.php';
include_once 'app/Redireccion.inc.php';

function aleatorio($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrestvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nro_caracteres = strlen($caracteres);
    $texto_a = '';
    
    for($i = 0; $i < $longitud; $i++){
        $texto_a .= $caracteres[(rand(0, $nro_caracteres -1))];
    }
    
    return $texto_a;
}
if(isset($_POST['enviar'])){
    $email = $_POST['email'];
    
    Conexion::abrir_conexion();
    if(!RepositorioUsuario::email_existe(Conexion::obtener_conexion(), $email)){
        Redireccion::redirigir(SERVIDOR);
        return;
    }
    
    $usuario = RepositorioUsuario::obtener_usuario_email($email, Conexion::obtener_conexion());
    $nombre_usuario = $usuario ->obtener_nombre();
    $string_aleatorio = aleatorio(10);
    
    $url_secreta = hash('sha256', $string_aleatorio . $nombre_usuario);
    
    $peticion_recuperacion = RepositorioRecuperarClave::generar_peticion($usuario->obtener_id(), $url_secreta, Conexion::obtener_conexion());
    
    Conexion::cerrar_conexion();
    
    if($peticion_recuperacion){
        Redireccion::redirigir(SERVIDOR);
    }
}
