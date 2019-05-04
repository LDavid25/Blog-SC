<div class="col-md-3">
    <?php
    if (file_exists(DIRECTORIO_RAIZ . "/subidas/" . $usuario->obtener_id())) {
        ?>
        <img class="rounded mx-auto" src="<?php echo SERVIDOR . '/subidas/' . $usuario->obtener_id(); ?>">
        <?php
    } else {
        ?>
        <img src="<?php echo IMG; ?>user.png" class="img-fluid">
        <?php
    }
    ?>
    <br>
</div>
<div class="col-md-6">
    <h4><small>Nombre del usuario</small></h4>
    <h4><?php echo $usuario->obtener_nombre(); ?></h4>
    <br>
    <h4><small>Email</small></h4>
    <h4><?php echo $usuario->obtener_email(); ?></h4>
    <br>
    <h4><small>Usuario desde</small></h4>
    <h4><?php echo $usuario->obtener_fecha_registro(); ?></h4>
    <br>
</div>
