<div class="container perfil card card-borde">
    <div class="row">
        <?php include 'plantillas/carta_perfil.inc.php'; ?>
        <div class="col-md-3">   
            <div class="d-flex align-items-end flex-column">
                <?php if ($usuario->obtener_id() === $_SESSION['id_usuario']) { ?>
                    <a href="<?php echo PERFIL_EDITAR ?>" class="btn btn-lg btn-primary" id="boton-nueva-entrada" role="button"><i class="fas fa-sync-alt fa-spin"></i> Actualizar Datos</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
