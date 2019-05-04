<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Registro Completado';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-5"> ¡FELICIDADES <strong><?php echo $cadena =str_replace("%20"," ",$nombre); ?></strong>!, </h1>
        <br>
        <p>Te has registrado correctamente. Ahora puedes realizar acciones exclusivas como miembro.<br><br> <a href="<?php echo LOGIN ?>"> inicia sesión</a></p>      
    </div>
</div>

<?php
include_once 'plantillas/declaracion_cierre.inc.php';
?>