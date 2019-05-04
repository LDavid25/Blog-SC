<?php
include_once 'app/config.inc.php';
$titulo = 'Gestion de Usuarios';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';

Conexion :: abrir_conexion();
$array_usuarios = RepositorioUsuario :: obtener_usuario_fecha_descendente(Conexion::obtener_conexion(), $_SESSION['id_usuario'], 0);
?>

<div class="container card card-borde">
    <div class="row">
        <div class="col-md-12">
            <div class="row pg-entradas">
                <div class="col-md-12">
                    <h2 class="display-5 text-center">Gestión de Usuarios Registrados</h2>
                    <br>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <?php
                    if (count($array_usuarios) > 0) {
                        ?>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Nombre de Usuario</th>
                                    <th>Estado de Cuenta</th>
                                    <th>Comentarios</th>
                                    <th>Opciones</th>
                                    <?php
                                    if ($_SESSION['tipo'] == '2') {
                                        ?>
                                        <th>Permisos</th>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($array_usuarios); $i++) {
                                    $actual = $array_usuarios[$i][0];

                                    $cantidad_comentarios_usuario = RepositorioUsuario :: obtener_cantidad_comentario_usuario(Conexion::obtener_conexion(), $actual->obtener_id());
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $i + 1; ?></strong></td>
                                        <td><?php echo $actual->obtener_fecha_registro(); ?></td>
                                        <td><?php echo $actual->obtener_nombre(); ?></td>
                                        <td>
                                            <?php
                                            if ($actual->obtener_activo()) {
                                                ?>
                                                <i class="far fa-times-circle fa-2x text-danger"></i> 
                                                <?php
                                            } else {
                                                ?>
                                                <i class="far fa-check-circle fa-2x text-success"></i>
                                                <?php
                                            }
                                            ?>    
                                        </td>
                                        <td>
                                            <?php echo $cantidad_comentarios_usuario; ?>
                                        </td>
                                        <td >
                                            <?php
                                            if ($actual->obtener_activo() == '0') {
                                                ?>
                                                <form method="post" action="<?php echo HABILITAR_USUARIO; ?>">
                                                    <input type="hidden" name="id_usuario" value="<?php echo $actual->obtener_id(); ?>">
                                                    <?php
                                                    if ($actual->obtener_id() === $_SESSION['id_usuario']) {
                                                        ?> 
                                                        <button type="button" class="btn btn-secondary btn-lg" disabled>Habilitado</button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button type="submit" class="btn btn-danger btn-xs" name="hab_usuario"> Deshabilitar</button>
                                                        <?php
                                                    }
                                                    ?>
                                                </form>
                                                <?php
                                            } else if ($actual->obtener_activo() == '1') {
                                                ?>
                                                <form method="post" action="<?php echo HABILITAR_USUARIO; ?>">
                                                    <input type="hidden" name="id_usuario" value="<?php echo $actual->obtener_id(); ?>">
                                                    <?php
                                                    if ($actual->obtener_id() === $_SESSION['id_usuario']) {
                                                        ?> 
                                                        <button type="button" class="btn btn-secondary btn-lg" disabled>Habilitado</button>
                                                        <?php
                                                    } else {
                                                        ?>        
                                                        <button type="submit" class="btn btn-success btn-xs" name="hab_usuario">Habilitar</button> 
                                                        <?php
                                                    }
                                                    ?>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($_SESSION['tipo'] == '2') {
                                                ?>
                                                <form method="post" action="<?php echo HABILITAR_USUARIO; ?>">
                                                    <div class="form-row align-items-center">
                                                        <div class="col-auto">
                                                            <label class="sr-only" for="inlineFormCustomSelect">Preferencia</label>
                                                            <select class="custom-select" id="inlineFormCustomSelect" name="valor">
                                                                <option selected>
                                                                    <?php
                                                                    if ($actual->obtener_tipo() == '0') {
                                                                        echo 'Miembro';
                                                                    } else if ($actual->obtener_tipo() == '1') {
                                                                        echo 'Admin';
                                                                    } else {
                                                                        echo 'SU';
                                                                    }
                                                                    ?>
                                                                </option>
                                                                <option value="1">Miembro</option>
                                                                <option value="2">Admin</option>
                                                                <option value="3">SU</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="id_usuario_tipo" value="<?php echo $actual->obtener_id(); ?>">
                                                        <button type="submit" name="autorizar" class="btn btn-primary">Autorizar</button>

                                                    </div>
                                                </form>
                                                <?php
                                            }
                                            ?>
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
                        <div class="text-center text-muted">
                            <h3>Aun no hay usuarios registrados</h3>
                        </div>
                        <br>           
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
