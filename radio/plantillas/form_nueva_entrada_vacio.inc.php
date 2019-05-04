<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo de la entrada">
</div>

<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" rows="7" id="contenido" name="texto" placeholder="Escribe aqui"></textarea>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si"> 
        Marque si quiere publicar de inmediato
    </label>
</div>
<br>
<button type="submit" class="btn btn-success" name="guardar">Guardar entradas</button>
<a href="<?php echo GESTOR_ENTRADAS ?>" class="btn btn-danger ml-5">Atrás</a>
