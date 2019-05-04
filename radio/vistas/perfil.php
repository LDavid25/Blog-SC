<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: ". gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pagma: no-cache");

    include_once 'app/Conexion.inc.php';
    include_once 'app/Config.inc.php';
    include_once 'app/Usuario.inc.php';
    include_once 'app/RepositorioUsuario.inc.php';
    include_once 'app/ValidadorPerfilNombre.inc.php';
    include_once 'app/ValidadorPerfilClave.inc.php';
    include_once 'app/ControlSesion.inc.php';
    include_once 'app/Redireccion.inc.php';
   
    //validadcion de usuario en sesion y configuracion de archivo adjuntado

    if(!ControlSesion :: sesion_iniciada()){
        Redireccion :: redirigir(SERVIDOR);
    } else {
        Conexion :: abrir_conexion();
        $id = $_SESSION['id_usuario'];
        $Nombre = $_SESSION['nombre_usuario'];
        $usuario = RepositorioUsuario :: obtener_usuario_id( $id, Conexion::obtener_conexion());

    }
    if (isset($_POST['guardar_imagen']) && !empty($_FILES['archivo_subido']['tmp_name'])){
        $directorio = DIRECTORIO_RAIZ."/subidas/";
        $carpeta_objetivo = $directorio.basename($_FILES['archivo_subido']['name']);
        $subida_correcta = 1;
        $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);

        $comprobacion = getimagesize($_FILES['archivo_subido']['tmp_name']);
        if($comprobacion !== false){
            $subida_correcta = 1;
        } else {
            $subida_correcta = 0;
        }
        if($_FILES['archivo_subido']['size'] > '1024000'){
            return "<div class='alert alert-danger text-center lead my-0'>El archivo no puede ocupar más de <strong>1MB</strong></div>";
            $subida_correcta = 0;
        }
        if($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif"){
            echo "<div class='alert alert-warning text-center lead my-0'>Solo se admiten los formatos <strong>JPG, JPEG, PNG y GIF</strong></div>";
            $subida_correcta = 0;
        }
        if($subida_correcta == 0){
            echo "<div class='alert alert-warning text-center lead my-0'>Tu archivo no puede subirse</div>";
        } else {
            if (move_uploaded_file($_FILES['archivo_subido']['tmp_name'], DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id())){
                echo "<div class='alert alert-success text-center my-0'>El archivo <strong>".basename($_FILES['archivo_subido']['name'])."</strong> ha sido subido.</div>";
            } else {
                echo "<strong>Ha ocurrido un error.</strong>";
            }
        }
    }

    //validacion de datos ingresados
    Conexion :: abrir_conexion();
    $cambio_efectuado = 0;
    if(isset($_POST['guardar_nombre'])) {
    
        $validadorNombre = new ValidadorPerfilNombre($_POST['nombre'], Conexion :: obtener_conexion());
                   
    
        if ($validadorNombre -> nombre_valido() ) {           
            $cambio_efectuado = RepositorioUsuario :: actualizar_nombre_por_id(Conexion :: obtener_conexion(), $id, $validadorNombre-> obtener_nombre());
        } 
    }

     if(isset($_POST['guardar_clave'])) {
        $validadorClave = new ValidadorPerfilClave($_POST['clave1'], $_POST['clave2'], Conexion :: obtener_conexion());                  
        if($validadorClave -> clave_valido()){
            $cambio_efectuado = RepositorioUsuario :: actualizar_clave_por_id(Conexion :: obtener_conexion(), $id, password_hash($validadorClave -> obtener_clave(), PASSWORD_DEFAULT));           
    }
}
    if ($cambio_efectuado) {
          $usuario = RepositorioUsuario :: obtener_usuario_id( $id, Conexion::obtener_conexion());   
          $_SESSION['nombre_usuario'] = $usuario -> obtener_nombre();        
          Redireccion :: redirigir(PERFIL);
    }   

    Conexion:: cerrar_conexion();

    $titulo = 'Perfil de ' . $usuario->obtener_nombre();
    include_once 'plantillas/declaracion_inicio.inc.php';    
    include_once 'plantillas/navbar.inc.php';
       
 switch ($perfil_actual){
       case '':

           include_once 'plantillas/perfil_basico.inc.php';

         break;
    case 'actualizando':
?>
                    <div class="container perfil card card-borde">
                        <div class="card-heading text-center">
                            <h2>Editar Perfil</h2>
                        </div>
                        <div class="row">                 
                            <div class="col-md-1"></div>
                            <div class="col-md-3 card">

                                <?php
                                    if(file_exists(DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id())){  
                                ?>
                                <img src="<?php echo SERVIDOR.'/subidas/'.$usuario->obtener_id(); ?>" class="rounded img-fluid">
                                        <?php
                                    } else {
                                        ?>
                                <img src="<?php echo IMG; ?>user.png" class="img-fluid">
                                        <?php
                                    }
                                ?>
                            <br>
                                 <form class="text-center" action="<?php echo PERFIL; ?>" method="post" enctype="multipart/form-data">
                                    <label for="archivo_subido" id="label-archivo"><i class="fas fa-upload"></i> Subir Foto de Perfil</label>
                                    <input type="file" name="archivo_subido" id="archivo_subido" class="boton_subir">
                                    <br>
                                    <input type="submit" value="Guardar Foto" name="guardar_imagen" class="form-control">
                                </form>
                            </div>
                                <div class=" col-md-6">
                                    <div class="accordion" id="editar_perfil">
                                      <div class="card">
                                        <div class="card-header" id="headerNombre">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseNombre" aria-expanded="true" aria-controls="collapseNombre">
                                               Modificar Nombre y Apellido
                                            </button>
                                          </h5>
                                        </div>

                                        <div id="collapseNombre" class="collapse show" aria-labelledby="headerNombre" data-parent="#editar_perfil">
                                          <div class="card-body">
                                              <form role="form" method="post" action="<?php echo PERFIL_EDITAR; ?>">
                                                         <?php  
                                                    if(isset($_POST['guardar_nombre'])){
                                                           ?>  
                                                              <div class="col">
                                                                <label for="InputNombre">Nombre y Apellido</label>
                                                                <input type="text" class="form-control" name="nombre" value="<?php $usuario -> obtener_nombre(); ?>">
                                                                <small class="form-text text-muted">Ingrese su nombre y su apellido</small><?php
                                                                    $validadorNombre -> mostrar_error_nombre();
                                                                    ?>
                                                              </div>
                                                                <div class="justify-content-center form-inline btn-lg">
                                                                      <button type="submit" class="btn btn-lg btn-success" name="guardar_nombre"><i class="far fa-save"></i> Guardar Datos</button> 
                                                                </div>
                                                           <?php
                                                    } else{
                                                          ?> 
                                                            <div class="col">
                                                                <label for="InputNombre">Nombre y Apellido</label>
                                                                <input type="text" class="form-control" name="nombre" value="<?php echo $Nombre; ?>">
                                                                <small class="form-text text-muted">Ingrese su nombre y su apellido</small>
                                                            </div> 
                                                                <div class="justify-content-center form-inline btn-lg">
                                                                      <button type="submit" class="btn btn-lg btn-success" name="guardar_nombre"><i class="far fa-save"></i> Guardar Datos</button> 
                                                                </div>
                                                         <?php
                                                    }
                                                ?>
                                             </form>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-header" id="headerClave">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseClave" aria-expanded="false" aria-controls="collapseClave">
                                                Cambiar Contraseña
                                            </button>
                                          </h5>
                                        </div>
                                        <div id="collapseClave" class="collapse" aria-labelledby="headerClave" data-parent="#editar_perfil">
                                          <div class="card-body">
                                            <form role="form" method="post" action="<?php echo PERFIL_EDITAR; ?>">
                                               <?php  
                                                    if(isset($_POST['guardar_clave'])){
                                                        include_once 'plantillas/perfil_validado.inc.php';
                                                    } else{
                                                        include_once 'plantillas/perfil_vacio.inc.php';
                                                    }
                                                ?>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                            </div>
                            <div class="col-md justify-content-center form-inline btn-lg">
                             <a href="<?php echo RUTA_PERFIL ?>" class="btn btn-lg btn-primary" id="boton-nueva-entrada" role="button"><i class="fas fa-undo-alt"></i> Regresar</a>
                            </div>
                            
                     </div>
                </div>
<?php
          break;           
          }
include_once 'plantillas/declaracion_cierre.inc.php';   

?>
