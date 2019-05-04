<input type="hidden" id="id-entrada" name="id-entrada" value="<?php echo $id_entrada; ?>">
<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo la entrada"
           value="<?php echo $validador->obtener_titulo(); ?>">
    <input type="hidden" id="titulo-original" name="titulo-original" value="<?php echo $entrada_recuperada->obtener_titulo(); ?>">
    <?php
    $validador->mostrar_error_titulo();
    ?>
</div>

<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" rows="7" id="texto" name="texto" placeholder="Escribe aqui"
              ><?php echo $validador->obtener_texto(); ?></textarea>
    <input type="hidden" id="texto-original" name="texto-original" value="<?php echo $entrada_recuperada->obtener_texto(); ?>">
    <?php
    $validador->mostrar_error_texto();
    ?>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if ($validador->obtener_checkbox())
        echo 'checked';
    ?>>Marque si quiere publicar de inmediato
        <input type="hidden" id="publicar-original" name="publicar-original" value="<?php echo $entrada_recuperada->esta_activo(); ?>">
    </label>
</div>
<br>
<button type="submit" class="btn btn-success" name="guardar_cambios_entrada">Guardar cambios</button>
<a href="<?php echo GESTOR_ENTRADAS ?>" class="btn btn-danger ml-5">Atrás</a>

