<?php
include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'RepositorioEntradas.inc.php';
include_once 'Redireccion.inc.php';

if(isset($_POST['borrar_entrada'])){
    $id_entrada = $_POST['id_borrar'];    
    
    Conexion :: abrir_conexion();
    
    RepositorioEntradas :: eliminar_comentarios_y_entradas(Conexion :: obtener_conexion(), $id_entrada);
    
    Conexion :: cerrar_conexion();
    
    Redireccion :: redirigir(GESTOR_ENTRADAS);
}
