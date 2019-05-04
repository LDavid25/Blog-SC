<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioLikes.inc.php';
$titulo = 'Gestion de Entradas';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';

Conexion :: abrir_conexion();

$array_entradas = RepositorioEntradas :: obtener_entradas_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
if($_SESSION['tipo'] == '2'){
    $array_entradas = RepositorioEntradas :: obtener_todas_entradas_fecha_descendente(Conexion::obtener_conexion());
}

?>

<div class="container card card-borde">
    <div class="row">
        <div class="col-md-12">

            <div class="row pg-entradas">
                <div class="col-md-12 text-center">
                    <h2 class="display-5 text-center">Gestión de Entradas</h2>
                    <br>
                    <a href="<?php echo NUEVA_ENTRADA ?>" class="card-borde parpadea-entrada btn btn-lg btn-primary w-50" id="boton-nueva-entrada" role="button"><i class="fa fa-newspaper"></i> <strong>Crear Nueva Entrada</strong></a>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row  text-center">
                <div class="col-md-12">
                    <?php
                    if (count($array_entradas)) {
                        ?>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Titulo</th>
                                    <th>Estado</th>
                                    <th><i class="fa fa-comment-dots"></i> - <i class="fa fa-star"></i></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($array_entradas); $i++) {
                                        $entrada_actual = $array_entradas[$i][0];
                                        $comentarios_entrada_actual = $array_entradas[$i][1];
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $i+1; ?></strong></td>
                                            <td><?php echo $entrada_actual->obtener_fecha(); ?></td>
                                            <td>
                                                <?php echo $entrada_actual->obtener_titulo(); ?></td>
                                            <td><?php
                                                if ($entrada_actual->obtener_activo()) {
                                                    ?>
                                                    <i class="far fa-check-circle fa-2x text-success"></i> 
                                                    <?php
                                                } else {
                                                    ?>
                                                    <i class="far fa-times-circle fa-2x text-danger"></i> 
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $comentarios_entrada_actual . ' <strong>-</strong> ' . RepositorioLikes::obtener_cantidad_likes_entrada($entrada_actual->obtener_id(), Conexion::obtener_conexion()); ?></td>
                                            <td>
                                                <form method="post" action="<?php echo EDITAR_ENTRADA; ?>">
                                                    <input type="hidden" name="id_editar" value="<?php echo $entrada_actual->obtener_id(); ?>">
                                                    <button type="submit" class="btn btn-secondary btn-xs" name="editar_entrada"><i class="fas fa-edit"></i> Editar</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="<?php echo BORRAR_ENTRADA; ?>">
                                                    <input type="hidden" name="id_borrar" value="<?php echo $entrada_actual->obtener_id(); ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs" name="borrar_entrada"><i class="fas fa-trash-alt"></i> Borrar</button>
                                                </form>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                
                                ?>
                            </tbody>
                        </table>                                        
                    
                        <?php
                    } else {
                        ?>
                        <div class="card border-0 my-3">
                            <div class="card-body">
                                <div class="card-title text-center text-muted">
                                    <h3>Aun no has creado entradas</h3>
                                </div>
                                <div class="card-text text-muted text-center">
                                    <i class="fa fa-clock"></i>
                                    Presiona el boton Amarillo y crea tu primera entrada. 
                                    <br>
                                    <strong>¿Qué esperas...?</strong>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'plantillas/top.inc.php';
include_once 'plantillas/declaracion_cierre.inc.php';
