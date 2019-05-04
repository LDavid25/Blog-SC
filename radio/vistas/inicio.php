<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container mt-2">
    <div class="row">
        <div class="col-md-9">
            <div class="tab-pane rounded" style="background-color: rgba(0,0,0,.07);">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel" data-slide-to="1"></li>
                        <li data-target="#carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner carrusel-img rounded mx-auto">
                        <?php
                        $carruseles = RepositorioCarrusel::obtener_todos_datos_carrusel(Conexion::obtener_conexion());
                        if($carruseles){
                            foreach ($carruseles as $c) {
                                ?>
                                <div class="carousel-item <?php if ($c->obtener_id() == 1) { echo 'active'; } ?>">
                                    <img class="rounded mx-auto d-block img-fluid img-carrusel" src="<?php echo SERVIDOR . '/subidas/carrusel/' . $c->obtener_id(); ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block text-carrusel rounded">
                                        <h5 class="text-carrusel-h5"><?php echo $c->obtener_titulo(); ?></h5>
                                        <p><?php echo $c->obtener_texto(); ?></p>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                        ?>
                        <div class="carousel-item active">
                                    <img class="rounded mx-auto d-block img-carrusel" src="<?php echo INSIGNIA; ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block text-carrusel rounded mb-5">
                                        <h5 class="text-carrusel-h5">Escuela Jose Gil Fourtoul</h5>
                                        <p class="mb-5">Le damos la bienvenida a todos y tadas, Gracias por visitarnos.</p>
                                    </div>
                                </div>
                        <?php
                        }
                        ?>

                    </div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <i class="fa fa-caret-left fa-3x text-negro"></i>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <i class="fa fa fa-caret-right fa-3x text-negro"></i>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center banner-principal-iconos">
            <div class="row">
                <div class="col-md-6 banner-principal-iconos-individual">
                    <a href="<?php echo MISION ?>" class="btn btn-block">
                        <i class="fa fa-flag"></i>
                        <br>
                        <h4>Misión</h4>
                    </a>
                </div>   
                <div class="col-md-6 banner-principal-iconos-individual">
                    <a href="<?php echo VISION ?>" class="btn btn-block">
                        <i class="fa fa-eye"></i>
                        <br>
                        <h4>Visión</h4>
                    </a>
                </div> 
            </div>
            <div class="row mt-1 mb-5">
                <div class="col-md-6 banner-principal-iconos-individual">
                    <a href="<?php echo NOSOTROS ?>" class="btn btn-block">
                        <i class="fa fa-users"></i>
                        <br>
                        <h4>Nosotros</h4>
                    </a>
                </div>
                <div class="col-md-6 banner-principal-iconos-individual">
                    <a href="<?php echo RESENA ?>" class="btn btn-block">
                        <i class="fa fa-book-reader"></i>
                        <br>
                        <h4>Reseña</h4>
                    </a>
                </div>
            </div>
<?php include 'plantillas/redes_sociales.inc.php'; ?>
        </div>
    </div>
    <hr>
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="row">

<?php include_once 'plantillas/buscar.inc.php'; ?>

            </div>
            <br>
            <br>
        </div>
        <div class="col-md-8">
            <div class="jumbotron-fluid text-center mb-1">
                <h2 class="display-5">
                    Ultimas entradas 
                </h2>
            </div>
            <?php
            EscritorEntradas::escribir_entradas();
            ?>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/footer.inc.php';
include_once 'plantillas/top.inc.php';
include_once 'plantillas/footer.inc.php';
include_once 'plantillas/declaracion_cierre.inc.php';
?>
