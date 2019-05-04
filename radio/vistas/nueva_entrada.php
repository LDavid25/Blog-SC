<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/RepositorioEntradas.inc.php';
include_once 'app/validadorEntrada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$entrada_publica = 0;
    if(isset($_POST['guardar'])){
       Conexion :: abrir_conexion();
        
       $url= str_replace(" ","-",$_POST['titulo']);
      
       $validador = new ValidadorEntrada($_POST['titulo'], $url , 
       
       htmlspecialchars($_POST['texto']), Conexion :: obtener_conexion());
        
       
       if(isset($_POST['publicar']) && $_POST['publicar'] == 'si'){
           $entrada_publica = 1;
       }
       if($validador -> entrada_valida()){
           if(ControlSesion :: sesion_iniciada()){
               $entrada = new Entradas('', $_SESSION['id_usuario'], $validador -> obtener_url(), $validador -> obtener_titulo(), $validador -> obtener_texto(), '', $entrada_publica);
               
               $entrada_insertada = RepositorioEntradas :: insertar_entrada(Conexion :: obtener_conexion(), $entrada);
                if($entrada_insertada){
                    Redireccion :: redirigir(GESTOR_ENTRADAS);
                }
           } else {
               Redireccion :: redirigir(LOGIN);
           }
           
            Conexion :: cerrar_conexion();
       }
    }

$titulo = 'Nueva entrada';

 include_once 'plantillas/declaracion_inicio.inc.php';    
    include_once 'plantillas/navbar.inc.php';
       
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-borde">
                <div class="card-heading text-center">
                    <h4>Nueva Entrada</h4>
                </div>
                <div class="card-body">
                    <img src="<?php echo IMG;?>user.png" width="300" height="1000" class="img-fluid" alt="Responsive image">
                    <form class="form-nueva-entrada" method="post" action="<?php echo NUEVA_ENTRADA ?>">
                    <?php
                        if (isset($_POST['guardar'])){
                                include_once 'plantillas/form_nueva_entrada_validado.inc.php';
                        } else { 
                                include_once 'plantillas/form_nueva_entrada_vacio.inc.php';
                               }
                    ?>
                    </form> 
                </div>
            </div> 
        </div> 
    </div> 
</div> 
    
<?php
include_once 'plantillas/declaracion_cierre.inc.php';
?>