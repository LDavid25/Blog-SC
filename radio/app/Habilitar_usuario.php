<?php

include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'ControlSesion.inc.php';
include_once 'RepositorioUsuario.inc.php';
include_once 'Redireccion.inc.php';

if (isset($_POST['hab_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    Conexion :: abrir_conexion();

    $usuario = RepositorioUsuario :: obtener_usuario_id($id_usuario, Conexion :: obtener_conexion());
    $activo = $usuario->obtener_activo();

    RepositorioUsuario :: cambiar_activo_usuario(Conexion :: obtener_conexion(), $id_usuario, $activo);

    Conexion :: cerrar_conexion();

    Redireccion :: redirigir(GESTOR_USUARIOS);
}

if (isset($_POST['autorizar']) && $_SESSION['tipo'] == '2') {
    Conexion :: abrir_conexion();
    $permiso_otorgado = RepositorioUsuario::actualizar_permiso_usuario($_POST['id_usuario_tipo'], $_POST['valor'], Conexion::obtener_conexion());
    Conexion :: cerrar_conexion();
    
    Redireccion :: redirigir(GESTOR_USUARIOS);
}
