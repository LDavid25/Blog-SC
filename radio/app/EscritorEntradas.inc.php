<?php
include_once 'app/Conexion.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/Comentarios.inc.php';
include_once 'app/RepositorioEntradas.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioComentarios.inc.php';
include_once 'app/RepositorioLikes.inc.php';

include_once 'plantillas/declaracion_inicio.inc.php';

class EscritorEntradas {

    public static function escribir_entradas() {
        $entradas = RepositorioEntradas::obtener_entradas_fecha_descendente(Conexion::obtener_conexion());

        if (count($entradas)) {
            foreach ($entradas as $entrada) {
                self::escribir_entrada($entrada);
            }
        } else {
            ?>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="card-title text-center text-muted">
                        <h3>Aun no hay entradas para mostrar</h3>
                    </div>
                    <div class="card-text text-muted text-center">
                        <i class="fa fa-clock"></i>
                        Pronto los administradores llenaran el sítio con información de Interés. 
                        <br>
                        <strong>Espera un poco...</strong>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public static function escribir_entrada($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>
        <?php $usuario = RepositorioUsuario::obtener_usuario_id($entrada->obtener_autor_id(), Conexion::obtener_conexion());?>
        <div class="card card-borde mt-1 mb-4">
            <div class="row">
                <div class="col-md-4 text-center"> 
                    <img class="card-img fa fa-images fa-10x" src="#" alt="img de la entrada">                   
                </div>
                <div class="col-md-8">
                    <div class=" card-header clearfix border-0 mb-0 pb-0 font-italic">
                        <div class="text-muted float-right">
                            <p><?php echo $entrada->obtener_fecha(); ?></p>
                        </div>
                        <div class="text-muted float-left">
                            <p><strong>Autor: </strong>
                                <a href="<?php  ?>"><?php echo $usuario->obtener_nombre(); ?></a>
                            </p>                
                        </div>
                    </div>
                    <div class="card-body mt-0 pt-0">
                        <div class="card-title">
                            <h4 class="lead text-azul">   
                                <?php
                                echo $entrada->obtener_titulo();
                                ?>
                            </h4>
                        </div>
                        <div class="card-text text-justificado">
                            <p>
                                <?php
                                echo self :: resumir_entrada_escrita(nl2br($entrada->obtener_texto()),250);
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer border-light clearfix">
                        <div class="float-right w-50 text-center">
                            <a href="<?php echo ENTRADA . '/' . $entrada->obtener_url(); ?>" class="btn btn-primary btn-block text-sign btn-efecto" style="border: 1px solid #ffd933; border-radius: .9rem;"> Leer <i class="fab fa-readme"></i></a>
                        </div>
                        <div class="float-left w-50 lead">
                            <span><?php echo RepositorioLikes::obtener_cantidad_likes_entrada($entrada->obtener_id(), Conexion::obtener_conexion()).' '; ?><i class="fa fa-star text-azul"></i></span>                          
                            <span><?php echo RepositorioComentarios::obtener_cantidad_comentarios($entrada ->obtener_id(), Conexion::obtener_conexion()) . ' ';?><i class="fa fa-comment-dots text-azul"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php     
    }

    public static function resumir_entrada_escrita($texto, $longitud_maxima) {
        if (strlen($texto) >= $longitud_maxima) {
            $texto_resumido = substr($texto, 0, $longitud_maxima) . ' ...';
        } else {
            $texto_resumido = $texto;
        }
        return $texto_resumido;
    }

}

include_once 'plantillas/declaracion_cierre.inc.php';
