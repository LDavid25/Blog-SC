<?php
include_once 'app/config.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioLikes.inc.php';

$titulo = 'Gestor General';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';

if (ControlSesion::sesion_iniciada()) {
    ?>

    <div class="container-fluid">
        <div class="row mb-5">
            <nav class="col-md-2 menu-gg d-none d-md-block bg-light sidebar rounded-bottom position-fixed">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column py-5 ">
                        <li>
                            <h1 class="text-center text-amarillof text-sign">
                                Gestión
                            </h1>
                            <hr class="border border-light">
                            <br>
                        </li>                    
                        <li class="nav-item">
                            <a href="<?php echo GESTOR_ENTRADAS ?>" class="nav-link text-center">
                                <i class="fa fa-newspaper fa-2x"></i> 
                                <br>
                                Entradas
                            </a>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo GESTOR_COMENTARIOS ?>" class="nav-link text-center">
                                <i class="fa fa-comment-dots fa-2x"></i> 
                                <br>
                                Comentarios
                            </a>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a  href="<?php echo GESTOR_USUARIOS ?>" class="nav-link text-center">
                                <i class="fa fa-user-friends fa-2x"></i>
                                <br>
                                Usuarios
                            </a>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a  href="<?php echo GESTOR_CARRUSEL ?>" class="nav-link text-center">
                                <i class="fa fa-images fa-2x"></i>
                                <br>
                                Carrusel
                            </a>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <br>
                            <br>
                            <a href="<?php echo LOGOUT ?>" class="nav-link text-center">
                                <i class="fa fa-sign-out-alt fa-2x"></i> 
                                <br>
                                Cerrar Sesión
                            </a>
                            <hr>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="offset-2 col-md-10 text-center resumen-gg ">
                <div class="row">
                    <div class="col-md-4">
                        <div class="vista-entradas-gg">
                            <i class="fa fa-newspaper fa-5x"></i>
                            <br>
                            <small class="lead">
                                <?php echo $total_entradas_activas = RepositorioEntradas :: obtener_total_entradas('1', Conexion::obtener_conexion())?>    
                            </small>
                            <p>Entradas Publicadas</p>                           
                            <hr>
                            <small class="lead">
                                <?php echo $total_entradas_activas = RepositorioEntradas :: obtener_total_entradas('0', Conexion::obtener_conexion())?>
                            </small>
                            <p>Borradores</p>                                                      
                            <hr>
                            <small class="lead">
                                <?php echo RepositorioLikes::obtener_entradas_con_like(Conexion::obtener_conexion()); ?>
                            </small>
                            <p>Entradas con ¡Me Gusta!</p>                                                      
                        </div>
                    </div>
                    <div class="col-md-4 px-0">
                        <div class="vista-comentarios-gg">
                            <i class="fa fa-comment-dots fa-5x"></i>
                            <br>
                            <small class="lead"><?php echo $total_comentarios = RepositorioComentarios :: obtener_cantidad_comentarios('0', Conexion::obtener_conexion()); ?></small>
                            <p>Comentarios Escritos</p>
                            <hr>
                            <i class="fa fa-star fa-5x"></i>
                            <br>
                            <small class="lead"><?php echo RepositorioLikes::obtener_total_likes(Conexion::obtener_conexion()); ?></small>
                            <p>Total ¡Me Gusta!</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vista-usuarios-gg">
                            <i class="fa fa-user-friends fa-5x"></i>
                            <br>
                            <small class="lead"><?php echo $total_us; ?></small>
                            <p>Usuarios Registrados</p>
                            <hr>
                            <small class="lead">
                            <?php echo $total_us_comun = RepositorioUsuario :: obtener_tipos_de_usuarios('0', Conexion::obtener_conexion())?>    
                            </small>
                            <p>usuarios comunes</p>
                            <hr>
                            <small class="lead">
                                <?php echo $total_us_comun = RepositorioUsuario :: obtener_tipos_de_usuarios('1', Conexion::obtener_conexion())?>
                            </small>
                            <p>Administradores</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="offset-2 border">
        <div class="row">
            <div class="offset-2 col-md-10 mt-5">
                <h4 class="mb-0">Usuarios recientes</h4>
                <div class="card card-borde mt-0">
                    <div class="card-body">
                        <?php
                        if ($array_usuarios) {
                            for ($i = 0; $i < count($array_usuarios); $i++) {
                                $actual = $array_usuarios[$i][0];
                                ?> 
                                <div class="row">
                                    <div class="resumen-usuario-gg d-flex">
                                        <img src="img/user.png" class="img-thumbnail rounded-circle" style="width:45px;">
                                        <p class="lead"><?php echo $actual->obtener_nombre(); ?> </p>
                                        <p><?php echo $actual->obtener_email(); ?> </p>
                                        <p><?php echo $actual->obtener_fecha_registro(); ?> </p>                                
                                    </div>
                                </div>
                                <hr class="border border-danger">
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="offset-2 col-md-10 mt-5">
                <h4 class="mb-0">Comentarios Recientes</h4>
                <div class="card card-borde mt-0">
                    <div class="card-body">
                        <?php
                        if ($array_comentarios) {
                            for ($i = 0; $i < count($array_comentarios); $i++) {
                                $comentarios_actual = $array_comentarios[$i][0];
                                $nombre_usuario_actual = $array_comentarios[$i][1];
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="lead"><?php echo $nombre_usuario_actual; ?>
                                        </p>
                                        <p class="text-muted"><?php echo $comentarios_actual->obtener_fecha(); ?></p>
                                    </div>
                                    <div class="col-md-8">
                                        <?php
                                        $ir_entrada = RepositorioEntradas :: obtener_entrada_por_id(Conexion::obtener_conexion(), $comentarios_actual->obtener_autor_id());
                                        ?>
                                        <p class="text-muted"><strong><?php echo $comentarios_actual->obtener_titulo(); ?></strong></p>
                                        <p class="text-muted"><?php echo $comentarios_actual->obtener_texto(); ?></p>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="<?php echo ENTRADA . '/' . $ir_entrada->obtener_url(); ?>" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <hr class="border border-danger">
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
            <div class="row mt-5">
        <div class="offset-2 col-md-10 text-center" style="background-color: var(--negrof); padding-top: .5rem;">
            <p><a href=" <?php echo CREADORES ?>" class="text-muted"><i class="fab fa-creative-commons-by"></i> Servicio Comunitario UNEFA Lara 2018</a></p>
        </div>
    </div>

    <?php
} else {
    Redireccion::redirigir(SERVIDOR);
}
include_once 'plantillas/declaracion_cierre.inc.php';

