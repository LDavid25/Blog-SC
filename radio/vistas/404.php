<?php
header($_SERVER['SERVER_PROTOCOL'] . '404 Not Found', true, 404);
include_once 'app/config.inc.php';
$titulo = '404 No encontrado';
include_once 'plantillas/declaracion_inicio.inc.php';
?>

<nav class="navbar">
    <div class="container">
        <h3 style="color: var(--amarillof); font-size: 3.2rem;">404</h3>
    </div>
</nav>

<div class="container mt-2">
    <div class="row">
        <div class="col-md-4 text-center">
            <i class="fa fa-search-minus" style="font-size: 10rem; color: var(--negrof);"></i>
        </div>
        <div class="offset-1 col-md-7 text-negro">
            <div class="card text-center">
                <div class="card-header">
                    <h1>Página no encontrada</h1>
                </div>
                <div class="card-body">
                    <h5 class="card-title">La página a la cual quiere ingresar no existe.</h5>
                    <br>
                    <p class="card-text">Revise que la ruta en la barra de direcciones este correctamente escrita,
                    o vaya a la página de inicio dando clic en el botón</p>
                    <a href="<?php echo SERVIDOR ?>" class="btn btn-primary"><i class="fa fa-home"></i> Inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/declaracion_cierre.inc.php';