<script src="js/BarraSeguridad.js" type="text/javascript"></script>
<div class="row">
    <div class="col">
        <label for="InputNombre">Nombre y Apellido</label>
        <input type="text" name="nombre" class="form-control" <?php $validador -> mostrar_nombre() ?> required>
        <small class="form-text text-muted">Ingrese su nombre y su apellido</small>
        <?php
        $validador -> mostrar_error_nombre();
        ?>
    </div>
    <br>
    <div class="col">
        <label for="InputEmail">Dirección Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailAyuda" <?php $validador -> mostrar_email() ?> required>
        <small id="emailAyuda" class="form-text text-muted">Ingrese un email válido</small>
       <?php
        $validador -> mostrar_error_email();
        ?>
    </div>
</div>
<br>
<br>
<div class="row text-center">
    <div class="col">
        <label for="InputPass1">Contraseña</label>
        
        <div class="pwdwidgetdiv" id="claveDiv">
            <input type="password" name="clave1" class="form-control" id="inputPass1" aria-describedby="pass1Ayuda" required>
            
            <div class="pwdopsdiv">
                <a href="#">Mostrar</a>
            </div>
            <div class="pwdopsdiv">
                <a href="#">Generador</a>
            </div>
            
        </div>
        <script type="text/javascript">
            var barra = new claveSegura('claveDiv','clave1');
                barra.mostrarBarra();
		</script>
		<noscript>
            <div>
                <input type='password' id='clave1' name='clave1' />
            </div>		
		</noscript>
        <br>
        <small id="pass1Ayuda" class="form-text text-muted">Ingrese una contraseña segura (AbCd#./*123)</small>
    
        <?php
        $validador -> mostrar_error_clave1();
        ?>
    </div>
    <div class="col">
        <label for="InputPass2">Repita la Contraseña</label>
        <input type="password" name="clave2" class="form-control" id="inputPass2" aria-describedby="pass2Ayuda" required>
        <small id="pass2Ayuda" class="form-text text-muted">Repita la contraseña anterior</small>
        <?php
        $validador -> mostrar_error_clave2();
        ?>
    </div>
</div>
<br>
<br>
<br>
<div class="justify-content-center form-inline btn-lg">    
    <button type="reset" class="btn btn-lg btn-danger w-25"><i class="fa fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-lg btn-primary w-25" name="enviar"><i class="fa fa-sign-in-alt"></i> Registrar</button>
</div>
<br>
<br>
<br>
<a href="<?php echo LOGIN ?>">¿Ya estas registrado?</a>