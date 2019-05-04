<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo de la entrada"
           <?php $validador->mostrar_titulo(); ?> >
           <?php $validador->mostrar_error_titulo(); ?>
</div>

<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" rows="7" id="contenido" name="texto" placeholder="escriba aqui"
              ><?php $validador->mostrar_texto(); ?></textarea>
              <?php $validador->mostrar_error_texto(); ?>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if ($entrada_publica) echo 'checked'; ?>>
        Marque si quiere publicar de inmediato   
    </label>
</div>
<br>
<button type="submit" class="btn btn-successs" name="guardar">Guardar entrada</button>
<a href="<?php echo GESTOR_ENTRADAS ?>" class="btn btn-danger ml-5">Atrás</a>
