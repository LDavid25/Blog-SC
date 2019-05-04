<?php
// Informacion de Base de Datos
define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_BD', 'radio');

// Rutas
define('SERVIDOR', 'http://localhost/radio');
define('LOGIN', SERVIDOR.'/login');
define('SIGN', SERVIDOR.'/sign');
define('LOGOUT', SERVIDOR.'/logout');
define('REGISTRO_CORRECTO', SERVIDOR.'/registro-correcto');
define('ENTRADA', SERVIDOR.'/entrada');
define('ERROR404', SERVIDOR.'/404');
define("RUTA_PERFIL", SERVIDOR."/perfil");
define("PERFIL", SERVIDOR."/perfil");
define("PERFIL_EDITAR", RUTA_PERFIL."/actualizando");
define("GESTOR", SERVIDOR."/gestor");
define("GESTOR_ENTRADAS", SERVIDOR."/gestor_entradas");
define("GESTOR_COMENTARIOS", SERVIDOR."/gestor_comentarios");
define("GESTOR_USUARIOS", SERVIDOR."/gestor_usuarios");
define("GESTOR_CARRUSEL", SERVIDOR."/gestor_carrusel");
define("NUEVA_ENTRADA", SERVIDOR."/nueva_entrada");
define("BORRAR_ENTRADA", SERVIDOR."/borrar_entrada");
define("EDITAR_ENTRADA", SERVIDOR."/editar_entrada");
define("BORRAR_COMENTARIO", SERVIDOR."/borrar_comentario");
define("HABILITAR_USUARIO", SERVIDOR."/Habilitar_usuario");
define("RECUPERAR_CLAVE", SERVIDOR."/recuperar-clave");
define("GENERAR_URL_SECRETA", SERVIDOR."/generar_url_secreta");

//Rutas secundarias
define("MISION", SERVIDOR."/mision");
define("VISION", SERVIDOR."/vision");
define("NOSOTROS", SERVIDOR."/nosotros");
define("RESENA", SERVIDOR."/resena");
define("CREADORES", SERVIDOR."/creadores");

// Recursos, estilo y efectos
define('CSS' , SERVIDOR.'/css/');
define('JS' , SERVIDOR.'/js/');
define("DIRECTORIO_RAIZ", realpath(__DIR__. "/..")); 

// Imagenes
define('INSIGNIA', SERVIDOR.'/img/Insignia.png');
define('IMG' , SERVIDOR.'/img/');