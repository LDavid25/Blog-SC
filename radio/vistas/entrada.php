<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/Comentarios.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntradas.inc.php';
include_once 'app/RepositorioComentarios.inc.php';

$titulo = $entrada->obtener_titulo();
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container mb-0">
    <div class="row">
        <div class="col-md-12">
            <h1 class=" card text-center text-sign">
                <?php echo $entrada->obtener_titulo(); ?>
            </h1>
            <div class=" text-center text-muted">
                <br>
                <p>
                    <strong>Autor: </strong>
                    <a href="<?php  ?>" class="mr-5">
                        <?php echo $usuario->obtener_nombre(); ?>
                    </a>
                    <strong>Publicado: </strong>
                    <?php echo $entrada->obtener_fecha() ?>
                </p>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 text-center mb-5">
            <div class="banner-izq">
                <?php include_once 'plantillas/buscar.inc.php'; ?>
                <div class="card border-light mt-4">
                    <?php include_once 'plantillas/redes_sociales.inc.php'; ?>
                </div>
                    <?php include_once 'plantillas/likes.inc.php'; ?>
            </div>      
        </div>
        <div class="col-md-8 mt-5 contenedor-articulo">
            <div class="text-center">
                <img  class="img-fluid rounded" src="<?php echo INSIGNIA ?>" width="400" height="900">                
            </div>
            <div class="mt-2 mb-5">
                <article class="text-justificado mt-5">
                    <?php echo nl2br($entrada->obtener_texto()); ?>
                </article>
            </div>
        </div>          
    </div>
<?php include_once 'plantillas/entradas_azar.inc.php'; ?>
</div>

<?php
include_once 'plantillas/top.inc.php';
include_once 'plantillas/declaracion_cierre.inc.php';
