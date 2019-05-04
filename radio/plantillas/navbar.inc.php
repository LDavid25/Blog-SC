<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';

Conexion::abrir_conexion();
?>

<div id="top"><span class="sr-only">Top de la pagina, redireecion de boton TOP</span></div>

<nav class="navbar sticky-top navbar-expand-md"  role="navigation">
    <div class="container">
        <a class="navbar-brand" href="<?php echo SERVIDOR ?>">
            <img src="<?php echo INSIGNIA ?>" width="36" height="36" alt="logo Fortoul">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFortoul" aria-controls="navbarFortoul" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-th-large navbar-icono-callapse"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarFortoul">             

            <?php
            if (ControlSesion::sesion_iniciada()) {
                if ($_SESSION['tipo'] == '1' || $_SESSION['tipo'] == '2') {
                    ?>               
                    <ul class="nav navbar-nav">             <!- BOTONES A LA DERECHA -->             
                        <div class="d-flex">
                            <div class="btn btn-group">
                                <a href="<?php echo GESTOR ?>" type="button" class="btn btn-secondary text-sign"><i class="fa fa-cogs"></i> Gestión</a>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="MenuGestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span class="sr-only">menu dezplegable</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="MenuGestion">
                                    <a class="dropdown-item" href="<?php echo GESTOR_ENTRADAS; ?>"><i class="fa fa-newspaper"></i> Entradas</a>        
                                    <a class="dropdown-item" href="<?php echo GESTOR_COMENTARIOS; ?>"><i class="fa fa-comment-dots"></i> Comentarios</a>        
                                    <a class="dropdown-item" href="<?php echo GESTOR_USUARIOS; ?>"><i class="fa fa-user-friends"></i> Usuarios</a>
                                    <a class="dropdown-item" href="<?php echo GESTOR_CARRUSEL; ?>"><i class="fa fa-images"></i> Carrusel</a>
                                </div>
                            </div>
                            <div class="btn btn-group btn-menu-admin">
                                <a type="button" class="btn btn-secondary" href="<?php echo PERFIL ?>" id="usuario-login"><i class="fa fa-user"></i> <?php echo $_SESSION['nombre_usuario']; ?></a>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="MenuPerfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                    <span class="sr-only">menu dezplegable</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="MenuPerfil">
                                    <a class="dropdown-item" href="<?php echo PERFIL_EDITAR; ?>"><i class="fa fa-user-edit"></i> Editar Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo LOGOUT; ?>"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
                                </div>
                            </div>
                        </div>
                    </ul> 

                    <?php
                } else if ($_SESSION['tipo'] == 0) {
                    ?>
                <ul class="nav navbar-nav">             <!- BOTONES A LA DERECHA -->             
                    <div class="d-flex">
                        <div class="btn btn-group">
                            <a href="#" type="button" class="btn btn-secondary text-sign"><i class="fa fa-cogs"></i> Gestión</a>
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="MenuGestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span class="sr-only">menu dezplegable</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="MenuGestion">
                                        
                                <a class="dropdown-item" href="<?php echo GESTOR_COMENTARIOS; ?>"><i class="fa fa-comment-dots"></i> Comentarios</a>        
                                
                            </div>
                        </div>
                        <div class="btn btn-group btn-menu-admin">
                            <a type="button" class="btn btn-secondary" href="<?php echo PERFIL ?>" id="usuario-login"><i class="fa fa-user"></i> <?php echo $_SESSION['nombre_usuario']; ?></a>
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="MenuPerfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span class="sr-only">menu dezplegable</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="MenuPerfil">
                                <a class="dropdown-item" href="<?php echo PERFIL_EDITAR; ?>"><i class="fa fa-user-edit"></i> Editar Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo LOGOUT; ?>"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                </ul> 
                    <?php
                }
            } else {
                ?>   
                <ul class="nav navbar-nav">             <!- BOTONES A LA DERECHA -->             
                    <li class="nav-item"><a class="nav-link" href="#enVivo"><i class="fa fa-broadcast-tower"></i> EnVivo <span class="sr-only">Radio</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo LOGIN ?>"><i class="far fa-user"></i> Iniciar Sesión <span class="sr-only">Iniciar Sesión</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SIGN ?>"><i class="fa fa-sign-in-alt"></i> Registrarse <span class="sr-only">Registrarse</span></a></li>               
                        <?php
                    }
                    ?>                
            </ul>
        </div>
    </div>
</nav>

