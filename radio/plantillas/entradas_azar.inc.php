<?php
include_once 'app/EscritorEntradas.inc.php';
?>
    <div class="row">
        <div class="offset-md-3 col-md-9">
            <h3 class="display-5 pl-5 mt-5 text-center">Más entradas interesantes</h3>
        </div>
    </div>
    <div class="offset-md-3 row">
        <?php
        foreach ($entradas_azar as $entrada_actual) {
        ?>
        <div class="col-md-4 contenedor-entrada-azar">
            <div class="card card-borde card-deck">
                <div class="card-img text-center">
                    <img src="<?php echo INSIGNIA ?>" class="" width="200">
                </div>
                <div class="card-header text-titulo-azar">
                <?php echo $entrada_actual -> obtener_titulo(); ?>
                </div>
                <div class="card-body text-justificado text-text-azar">
                <?php echo EscritorEntradas::resumir_entrada_escrita(nl2br($entrada_actual -> obtener_texto()),150); ?>
                </div>
                <a href="<?php echo ENTRADA . '/' . $entrada_actual->obtener_url(); ?>" class="btn btn-block btn-primary">
                    <i class="fab fa-readme"></i>
                </a>            
            </div>
        </div>
            <?php
        }
        ?>
    </div>

<div class="offset-md-3 row">
    <div class="col-md-12 mt-5 mb-5">
        <hr>
    </div>
</div>