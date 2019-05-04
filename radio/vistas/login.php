<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['enviar'])) {
    Conexion :: abrir_conexion();
    
    $validador = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::obtener_conexion());

    if ($validador->obtener_error() === '' && !is_null($validador->obtener_usuario())) {
        ControlSesion::iniciar_sesion($validador->obtener_usuario()->obtener_id(), 
                $validador->obtener_usuario()->obtener_nombre(), $validador->obtener_usuario()->obtener_tipo());
        Redireccion::redirigir(SERVIDOR);
    }
    Conexion :: cerrar_conexion();
}

$titulo = 'Ingreso al Sistema';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            <form class="card card-borde" method="post" action="<?php echo LOGIN ?>">
                <div class="text-center">
                    <br>
                    <img src="<?php echo INSIGNIA; ?>" width="100" class="d-inline-block align-top">
                    <br>
                    <br>
                    <h1 class="lead">Iniciar Sesión</h1>
                    <br>
                    <div class="form-group">
                        <label for="InputEmail" class="sr-only">Dirección Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control text-center" placeholder="Dirección email" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="Inputclave" class="sr-only">Contraseña</label>
                        <input type="password" name="clave" id="inputclave" class="form-control text-center" placeholder=" • • • • • • • • " required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="recordar"> Recordar
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary w-50" type="submit" name="enviar">
                        <i class="fa fa-sign-in-alt"></i> Ingresar
                    </button>
                    <p class="mt-2 mb-3 text-muted">&copy; 2017-2018</p>
                    <?php
                    if (isset($_POST['enviar'])) {
                        $validador->mostrar_error();
                    }
                    ?>
                    
                    <a href="<?php echo RECUPERAR_CLAVE; ?>">¿Olvidaste la contraseña?</a>
                    <br>
                    <a href="<?php echo SIGN ?>">¿Aun no te has registrado?</a>
                </div>  
            </form>

        </div>
    </div>
</div>
<?php
include_once 'plantillas/declaracion_cierre.inc.php';
?>  