<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/RepositorioEntradas.inc.php';
include_once 'app/ValidadorEntradaEditada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

Conexion::abrir_conexion();

if (isset($_POST['guardar_cambios_entrada'])) {
    $entrada_publica_nueva = 0;
    if(isset($_POST['publicar']) && $_POST['publicar'] == 'si'){
        $entrada_publica_nueva = 1;
    }
    
    $url= str_replace(" ","_",$_POST['titulo']);
    
    $validador = new ValidadorEntradaEditada($_POST['titulo'], $_POST['titulo-original'],           $url,
            $url , htmlspecialchars($_POST['texto']), $_POST['texto-original'], 
            $entrada_publica_nueva, $_POST['publicar-original'], Conexion :: obtener_conexion());
    
    if(!$validador -> hay_cambios()){
        Redireccion :: redirigir(GESTOR_ENTRADAS);
    } else {
        if($validador -> entrada_valida()){
            $cambio_efectuado = RepositorioEntradas :: actualizar_entrada(Conexion :: obtener_conexion(), 
                                $_POST['id-entrada'], $validador -> obtener_titulo(), $validador -> obtener_url(),
                                $validador -> obtener_texto(), $validador -> obtener_checkbox());
            
            if($cambio_efectuado){
               Redireccion :: redirigir(GESTOR_ENTRADAS);
            }
        } else {
            echo 'ENTRADA NO VALIDA';
        }
    }
    
}

$titulo = "Editar entrada";

include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-borde">
                <div class="card-heading text-center">
                    <h4>Editar Entrada</h4>
                </div>
                <div class="card-body">
                    <form class="form-nueva-entrada" method="post" action="<?php echo EDITAR_ENTRADA ?>"> 
                        <?php
                        if (isset($_POST['editar_entrada'])) {
                            $id_entrada = $_POST['id_editar'];

                            $entrada_recuperada = RepositorioEntradas :: obtener_entrada_por_id(
                                                  Conexion::obtener_conexion(), $id_entrada);
 
                            include_once 'plantillas/form_entrada_recuperada.inc.php';

                            Conexion::cerrar_conexion();
                        }else if (isset($_POST['guardar_cambios_entrada'])) {
                            $id_entrada = $_POST['id-entrada'];
                            
                            $entrada_recuperada = RepositorioEntradas :: obtener_entrada_por_id(
                                                  Conexion::obtener_conexion(), $id_entrada);
                     
                            include_once 'plantillas/form_entrada_recuperada_validada.inc.php';
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
