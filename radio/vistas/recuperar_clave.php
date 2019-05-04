<?php

$titulo = 'Recuperar Contraseña';
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            <form class="card card-borde" method="post" action="<?php echo GENERAR_URL_SECRETA; ?>">
                <div class="text-center">
                    <br>
                    <img src="<?php echo INSIGNIA; ?>" width="100" class="d-inline-block align-top">
                    <br>
                    <br>
                    <h1 class="lead">Recuperar Contraseña</h1>
                    <br>
                    <p class="text-muted text-justify px-4"> Si a olvidado su contraseña, 
                    ingrese su correo en el formulario y se le enviará un email,
                    siempre y cuando el correo este registrado en nuestro sistema.</p>
                    <br>
                    <div class="form-group">
                        <label for="InputEmail" class="sr-only">Dirección Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control text-center" placeholder="Dirección email" required autofocus>
                    </div>
                    <button class="btn btn-lg btn-primary w-50" type="submit" name="enviar">
                        Recuperar
                    </button>
                    <br>
                    <br>
                </div>  
            </form>

        </div>
    </div>
</div>
<?php
include_once 'plantillas/declaracion_cierre.inc.php';
?>  
