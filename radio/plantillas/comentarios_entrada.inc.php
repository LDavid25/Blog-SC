<div class="row">
    <div class="col-md-3"></div>      
    <div class="col-md-9">      
        <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#comentarios">
            <?php echo "Ver comentarios (" . count($comentarios) . ")" ?>
        </button>
        <br>
        <br>
        <div id="comentarios" class="collapse">
            <?php
            for ($i = 0; $i < count($comentarios); $i++) {
                $comentario = $comentarios[$i][0];
                $autor_c = $comentarios[$i][1];
                
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default ">           
                            <div class="card-body">
                                    <div class="media">
                                        
                                         <?php
                                     if(file_exists(realpath(__DIR__. "/../subidas/".$comentario->obtener_autor_id()))){
                                         ?> 
                                     <img src="<?php echo SBD.$comentario->obtener_autor_id();?>" class="align-self-center mr-3 img-reponsive" width="64" height="64">
                                    <?php
                                        } else {
                                            ?>
                                               <img src="<?php echo IMG; ?>user.png" class="align-self-center mr-3" width="64" height="64">
                                            <?php
                                        }
                                    ?>
                                        
                                          <div class="media-body form-control">
                                             <p> <b class="mt-0 text.muted">
                                               <?php echo $autor_c;  ?>
                                              </b>
                                              <span>· <?php echo Tiempo::tiempo_recurrido($comentario -> obtener_fecha()); ?></span>
                                              </p> 
                                              
                                        
                                             <p><?php echo nl2br($comentario->obtener_texto()); ?>
                                                </p>
                                          </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>