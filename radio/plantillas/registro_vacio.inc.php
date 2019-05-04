<script src="js/BarraSeguridad.js" type="text/javascript"></script>
<div class="row">
    <div class="col">
        <label for="InputNombre">Nombre y Apellido</label>
        <input type="text" class="form-control" name="nombre" autofocus required>
        <small class="form-text text-muted">Ingrese su nombre y su apellido</small>
    </div>
    <br>
    <div class="col">
        <label for="InputEmail">Dirección Email</label>
        <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailAyuda" required>
        <small id="emailAyuda" class="form-text text-muted">Ingrese un email válido</small>
    </div>
</div>
<br>
<br>
<div class="row text-center">
    <div class="col">
        <label for="InputPass1">Contraseña</label>
        
        <div class="pwdwidgetdiv" id="claveDiv">
            <input type="password" class="form-control" name="clave1" id="inputPass1" aria-describedby="pass1Ayuda" required>
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
    </div>
    <div class="col">
         <label for="InputPass2">Repita la Contraseña</label>
        <input type="password" class="form-control" name="clave2" id="inputPass2" aria-describedby="pass2Ayuda" required>
        <small id="pass2Ayuda" class="form-text text-muted">Repita la contraseña anterior</small>
    </div>
</div>
<br>
<div class="justify-content-center form-inline btn-lg">    
    <button type="reset" class="btn btn-lg btn-danger w-25"><i class="fa fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-lg btn-primary w-25" name="enviar"><i class="fa fa-sign-in-alt"></i> Registrar</button>
</div>
<br>
<a href="<?php echo LOGIN ?>">¿Ya estas registrado?</a>
