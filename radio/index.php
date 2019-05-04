<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/Comentarios.inc.php';
include_once 'app/Carrusel.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntradas.inc.php';
include_once 'app/RepositorioComentarios.inc.php';
include_once 'app/RepositorioCarrusel.inc.php';

$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url['path'];

$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = 'vistas/404.php';

if ($partes_ruta[0] == 'radio') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = 'vistas/inicio.php';
    } else if (count($partes_ruta) == 2) {
        switch ($partes_ruta[1]) {
            case 'ingresar':
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'login':
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'registro':
                $ruta_elegida = 'vistas/sign.php';
                break;
            case 'sign':
                $ruta_elegida = 'vistas/sign.php';
                break;
            case 'salir':
                $ruta_elegida = 'vistas/logout.php';
                break;
            case 'logout':
                $ruta_elegida = 'vistas/logout.php';
                break;
            case 'perfil':
                $ruta_elegida = 'vistas/perfil.php';
                $perfil_actual = '';
                break;
            case 'recuperar-clave':
                $ruta_elegida = "vistas/recuperar_clave.php";
                break;
            case 'generar_url_secreta':
                $ruta_elegida = "app/generarUrlSecreta.inc.php";
                break;
            case 'gestor':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1'){
                    $ruta_elegida = 'vistas/gestor.php';
                    Conexion :: abrir_conexion();
                    $cantidad = '7';
                    $array_usuarios = RepositorioUsuario :: obtener_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $cantidad);
                    $array_comentarios = RepositorioComentarios :: obtener_comentarios_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $cantidad);
                    $total_us = RepositorioUsuario :: obtener_total_usuarios(Conexion::obtener_conexion());
                                    
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'gestor_carrusel':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'vistas/carrusel.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'gestor_entradas':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'vistas/gestor_entradas.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'gestor_comentarios':
                if (ControlSesion::sesion_iniciada()) {
                    $ruta_elegida = 'vistas/gestor_comentarios.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'gestor_usuarios':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'vistas/gestor_usuarios.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'nueva_entrada':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'vistas/nueva_entrada.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'editar_entrada':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'vistas/editar_entrada.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'borrar_entrada':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'app/borrar_entrada.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'borrar_comentario':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'app/borrar_comentario.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'Habilitar_usuario':
                if (ControlSesion::sesion_iniciada() && $_SESSION['tipo'] >= '1') {
                    $ruta_elegida = 'app/Habilitar_usuario.php';
                } else {
                    Redireccion::redirigir(SERVIDOR);
                }
                break;
            case 'mision':
                $ruta_elegida = 'vistas/mision.php';
                break;
            case 'vision':
                $ruta_elegida = 'vistas/vision.php';
                break;
            case 'nosotros':
                $ruta_elegida = 'vistas/nosotros.php';
                break;
            case 'resena':
                $ruta_elegida = 'vistas/resena.php';
                break;
            case 'creadores':
                $ruta_elegida = 'vistas/creadores.php';
                break;
        }
    } else if ((count($partes_ruta) == 3)) {
        if ($partes_ruta[1] == 'registro-correcto') {
            $nombre = $partes_ruta[2];
            $ruta_elegida = 'vistas/registroCorrecto.php';
        }

        if ($partes_ruta[1] == 'perfil') {
            switch ($partes_ruta[2]) {
                case 'actualizando':
                    $perfil_actual = 'actualizando';
                    $ruta_elegida = 'vistas/perfil.php';
                    break;
            }
        }

        if ($partes_ruta[1] == 'entrada') {
            $url = $partes_ruta[2];

            Conexion::abrir_conexion();
            $entrada = RepositorioEntradas::obtener_por_url($url, Conexion::obtener_conexion());

            if ($entrada != null) {
                $usuario = RepositorioUsuario::obtener_usuario_id($entrada->obtener_autor_id(), Conexion::obtener_conexion());

                $entradas_azar = RepositorioEntradas::obtener_entradas_azar(3, Conexion::obtener_conexion());

                $ruta_elegida = 'vistas/entrada.php';
            }
        }
    }
}
include_once $ruta_elegida;
