<?php
include_once 'app/RepositorioLikes.inc.php';
if (ControlSesion::sesion_iniciada()) {
    $msj = '';
    $voto = RepositorioLikes::comprobar_like_usuario_entrada($_SESSION['id_usuario'], $entrada->obtener_id(), Conexion::obtener_conexion());
    $total_votos = RepositorioLikes::obtener_cantidad_likes_entrada($entrada->obtener_id(), Conexion::obtener_conexion());
    if(isset($_POST['votar']) && !$voto){
        RepositorioLikes::insertar_like($_SESSION['id_usuario'], $entrada->obtener_id(), Conexion::obtener_conexion());
        $msj = '';
    }
    if($voto == '1'){ $msj= 'Ya votaste';}
    ?>
<div class="mt-3">  
    <form action="<?php echo ENTRADA . '/' . $entrada->obtener_url(); ?>" method="post">
        <label for="like" class="card like border-light">
            <a><small class="lead">¡ME GUSTA!</small>
                <br>
                <i class="fa fa-star fa-spin fa-2x parpadea-color"></i> 
            </a>
            <small class="lead"><?php echo $total_votos; ?></small>
            <small><?php echo $msj; ?></small>
        </label>
        <input type="submit" id="like" class="boton_subir" name="votar">
    </form>
</div>
    <?php
}