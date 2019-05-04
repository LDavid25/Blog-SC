<?php
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Gestion de Comentarios';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';

Conexion :: abrir_conexion();
$array_comentarios = RepositorioComentarios :: obtener_comentarios_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario'], '0');
$comentarios_usuario = RepositorioComentarios::obtener_comentarios_usuario($_SESSION['id_usuario'], Conexion::obtener_conexion());
$correcto = false;

if (isset($_POST['guardar_comentario']) && !empty($_POST['texto'])) {
    $id = $_POST['id_comentario'];
    $texto = $_POST['texto'];
    $comentarios_editado = RepositorioComentarios :: editar_comentario(Conexion::obtener_conexion(), $id, $texto);
    $array_comentarios = RepositorioComentarios :: obtener_comentarios_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario'], '0');
    $correcto = true;
}
?>

<div class="container card card-borde">
    <div class="row text-center">
        <div class="col-md-12">

            <div class="row pg-comentarios">
                <div class="col-md-12">
                    <h2 class="display-5 text-center">Gestión de Comentarios</h2>
                    <br>
                </div>
            </div>
            <div class="row pg-comentarios">
                <div class="col-md-12">
                    <?php
                    if (count($array_comentarios) > 0) {
                        ?>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Título</th>
                                    <th>Usuario</th>
                                    <th>Ver</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php
                                if ($_SESSION['tipo'] >= '1') {
                                    for ($i = 0; $i < count($array_comentarios); $i++) {
                                        $comentarios_actual = $array_comentarios[$i][0];
                                        $nombre_usuario_actual = $array_comentarios[$i][1];
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $i + 1; ?></strong></td>
                                            <td><?php echo $comentarios_actual->obtener_fecha(); ?></td>
                                            <td><?php echo $comentarios_actual->obtener_titulo(); ?></td>
                                            <td><?php echo $nombre_usuario_actual; ?></td>
                                            <td class="text-center">
                                                <div  id="ver1">
                                                    <?php $id_com = $comentarios_actual->obtener_id(); ?>
                                                    <button type="submit" class="btn btn-success" data-toggle="collapse" data-target="#<?php echo $id_com; ?>" aria-expanded="true" aria-controls="<?php echo $id_com; ?>" name="ver">   
                                                        <i class="far fa-eye"></i>
                                                    </button >
                                                </div>
                                                <div id="<?php echo $id_com; ?>" class="collapse" aria-labelledby="ver1" data->
                                                    <div class="card text-justify">
                                                        <?php echo $comentarios_actual->obtener_texto(); ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div id="editar">
                                                    <?php $id_coment = "1" . $i; ?>
                                                    <button type="submit" class="btn btn-secondary" data-toggle="collapse" data-target="#<?php echo $id_coment; ?>" aria-expanded="true" aria-controls="<?php echo $id_coment; ?>" name="ver"><i class="fa fa-pencil-alt"></i></button >
                                                </div>
                                                <div id="<?php echo $id_coment; ?>" class="collapse" aria-labelledby="editar">
                                                    <div class="card text-justify">
                                                        <form class="form-comentarios" method="post" action="<?php echo GESTOR_COMENTARIOS; ?>">   
                                                            <div class="form-group">
                                                                <label for="contenido">Contenido</label>
                                                                <textarea class="form-control" rows="5" id="texto" name="texto" placeholder="Escribe aqui"
                                                                          ><?php echo $comentarios_actual->obtener_texto(); ?></textarea>
                                                                <input type="hidden" id="id_coment" name="id_comentario" value="<?php echo $comentarios_actual->obtener_id(); ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-success" name="guardar_comentario">Guardar</button>
                                                            <a href="<?php echo GESTOR_COMENTARIOS; ?>" class="btn btn-danger" id="boton-c" role="button">Cancelar</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <form method="post" action="<?php echo BORRAR_COMENTARIO; ?>">
                                                    <input type="hidden" name="id_borrarC" value="<?php echo $comentarios_actual->obtener_id(); ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs" name="borrar_coment"><i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    for ($i = 0; $i < count($comentarios_usuario); $i++) {
                                        $comentario = $comentarios_usuario[$i];
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td><?php echo $comentario->obtener_fecha(); ?></td>
                                            <td><?php echo $comentario->obtener_titulo(); ?></td>
                                            <td><?php echo $_SESSION['nombre_usuario']; ?></td>
                                            <td class="text-center">
                                                <div  id="ver1">
                                                    <?php $id_com = $comentario->obtener_id(); ?>
                                                    <button type="submit" class="btn btn-success" data-toggle="collapse" data-target="#<?php echo $id_com; ?>" aria-expanded="true" aria-controls="<?php echo $id_com; ?>" name="ver">   
                                                        <i class="far fa-eye"></i>
                                                    </button >
                                                </div>
                                                <div id="<?php echo $id_com; ?>" class="collapse" aria-labelledby="ver1" data->
                                                    <div class="card text-justify">
                                                        <?php echo $comentario->obtener_texto(); ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div  id="editar">
                                                    <?php $id_coment = "2" . $i; ?>
                                                    <button type="submit" class="btn btn-secondary" data-toggle="collapse" data-target="#<?php echo $id_coment; ?>" aria-expanded="true" aria-controls="<?php echo $id_coment; ?>" name="ver"><i class="fa fa-pencil-alt"></i></button >
                                                </div>
                                                <div id="<?php echo $id_coment; ?>" class="collapse" aria-labelledby="editar" data->
                                                    <div class="card text-justify">

                                                        <form class="form-comentarios" method="post" action="<?php echo GESTOR_COMENTARIOS; ?>">   
                                                            <div class="form-group">
                                                                <label for="contenido">Contenido</label>
                                                                <textarea class="form-control" rows="5" id="texto" name="texto" placeholder="Escribe aqui"
                                                                          ><?php echo $comentario->obtener_texto(); ?></textarea>
                                                                <input type="hidden" id="id_coment" name="id_comentario" value="<?php echo $comentario->obtener_id(); ?>">
                                                            </div>

                                                            <button type="submit" class="btn btn-success" name="guardar_comentario">Guardar</button>
                                                            <a href="<?php echo GESTOR_COMENTARIOS; ?>" class="btn btn-danger" id="boton-c" role="button">Cancelar</a>

                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form method="post" action="<?php echo BORRAR_COMENTARIO; ?>">
                                                    <input type="hidden" name="id_borrarC" value="<?php echo $comentario->obtener_id(); ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs" name="borrar_coment"><i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            </td>

                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table> 
                            <?php
                        }
                    } else {
                        ?>
                        <div class="card border-0 my-3">
                            <div class="card-body">
                                <div class="card-title text-center text-muted">
                                    <h3>Aun no has comentado en ninguna entradas</h3>
                                </div>
                                <div class="card-text text-muted text-center">
                                    <i class="fa fa-clock"></i>
                                    Te invitamos a que compartas tus opiniones en cada entrada 
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
