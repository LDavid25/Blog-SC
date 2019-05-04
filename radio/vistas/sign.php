<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if(isset($_POST['enviar'])) {
    Conexion :: abrir_conexion();

    $validador = new ValidadorRegistro($_POST['nombre'], $_POST['email'],
            $_POST['clave1'], $_POST['clave2'], Conexion :: obtener_conexion());
    
        if ($validador -> registro_valido()) {
        $usuario = new Usuario('', $validador-> obtener_nombre(), 
                $validador -> obtener_email(), 
                password_hash($validador -> obtener_clave(), PASSWORD_DEFAULT), 
                '', 
                '',
                '1');
        $usuario_insertado = RepositorioUsuario :: insertar_usuario(Conexion :: obtener_conexion(), $usuario);
        
        if ($usuario_insertado) {
            Redireccion :: redirigir(REGISTRO_CORRECTO . '/' . $usuario ->obtener_nombre());
        }   
    }
    Conexion:: cerrar_conexion();
}

$titulo = 'Registro';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="row"><div class="col-md-1"></div>
        <div class="col-md-10 card card-borde mb-4">
            <div class="text-center">
                <img src="<?php echo INSIGNIA; ?>" width="100" class="d-inline-block align-top">
                <br>
                <h1 class="lead">Registro de Usuarios</h1>
                <br>
            </div>
            <form class="text-center text-sign" method="post" action="<?php echo SIGN ?>">
                <?php 
                    if(isset($_POST['enviar'])){
                        include_once 'plantillas/registro_validado.inc.php';
                    } else{
                        include_once 'plantillas/registro_vacio.inc.php';
                    }
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/declaracion_cierre.inc.php';
?>