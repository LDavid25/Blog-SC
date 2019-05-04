<?php
include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'RepositorioComentarios.inc.php';
include_once 'Redireccion.inc.php';

if(isset($_POST['borrar_coment'])){
    $id_comentarios = $_POST['id_borrarC'];    
    
    Conexion :: abrir_conexion();
    
    RepositorioComentarios :: eliminar_comentarios(Conexion :: obtener_conexion(), $id_comentarios);
    
    Conexion :: cerrar_conexion();
    
    Redireccion :: redirigir(GESTOR_COMENTARIOS);
}
