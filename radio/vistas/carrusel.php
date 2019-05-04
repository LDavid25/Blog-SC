<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pagma: no-cache");

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Carrusel.inc.php';
include_once 'app/RepositorioCarrusel.inc.php';
$titulo = "Gestión del Carrusel";
include_once 'plantillas/declaracion_inicio.inc.php';
include_once 'plantillas/navbar.inc.php';

$array_carrusel = RepositorioCarrusel::obtener_todos_datos_carrusel(Conexion::obtener_conexion());
$msj[] = '0';
foreach ($array_carrusel as $carrusel) {
    $msj[] = $carrusel->obtener_id();
}

if (isset($_POST['guardar_imagen0']) && !empty($_FILES['img-carrusel0']['tmp_name'])) {

    $directorio = DIRECTORIO_RAIZ . "/subidas/carrusel/";
    $carpeta_objetivo = $directorio . basename($_FILES['img-carrusel0']['name']);
    $subida_correcta = 1;
    $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);
    $comprobacion = getimagesize($_FILES['img-carrusel0']['tmp_name']);

    if ($comprobacion !== false) {
        $subida_correcta = 1;
    } else {
        $subida_correcta = 0;
    }
    if ($_POST['texto0'] == null || $_POST['titulo0'] == null || empty($_FILES['img-carrusel0']['tmp_name'])) {
        $subida_correcta = 0;
        echo "<div class='alert alert-danger text-center lead my-0'>Ningun campo puede estar vacio</div>";
    }
    if ($_FILES['img-carrusel0']['size'] > '5120000') {
        echo "<div class='alert alert-danger text-center lead my-0'>El archivo no puede ocupar más de <strong>5MB</strong></div>";
        $subida_correcta = 0;
    }
    if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
        echo "<div class='alert alert-warning text-center lead my-0'>Solo se admiten los formatos <strong>JPG, JPEG, PNG y GIF</strong></div>";
        $subida_correcta = 0;
    }
    if ($_POST['texto0'] == '' || $_POST['titulo0'] == '' || empty($_FILES['img-carrusel0']['tmp_name']) && $subida_correcta == 1) {
        echo "<div class='alert alert-warning text-center lead my-0'>Tu archivo no puede subirse</div>";
    } else {
        if (move_uploaded_file($_FILES['img-carrusel0']['tmp_name'], DIRECTORIO_RAIZ . "/subidas/carrusel/" . $_POST['idC'])) {
            echo "<div class='alert alert-success text-center my-0'>El archivo <strong>" . basename($_FILES['img-carrusel0']['name']) . "</strong> ha sido subido.</div>";
        } else {
            echo "<div class='alert alert-warning text-center lead my-0'><strong>Ha ocurrido un error.</strong></div>";
        }
        if (!in_array('1', $msj)) {
            RepositorioCarrusel::insertar_datos_carrusel('1', $_POST['titulo0'], $_POST['texto0'], Conexion::obtener_conexion());
        } else {
            RepositorioCarrusel::actualizar_datos_carrusel('1', $_POST['titulo0'], $_POST['texto0'], Conexion::obtener_conexion());
        }
    }
}

if (isset($_POST['guardar_imagen1']) && !empty($_FILES['img-carrusel1']['tmp_name'])) {
    $directorio = DIRECTORIO_RAIZ . "/subidas/carrusel/";
    $carpeta_objetivo = $directorio . basename($_FILES['img-carrusel1']['name']);
    $subida_correcta = 1;
    $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);
    $comprobacion = getimagesize($_FILES['img-carrusel1']['tmp_name']);
    if ($comprobacion !== false) {
        $subida_correcta = 1;
    } else {
        $subida_correcta = 0;
    }
    if ($_POST['texto1'] == '' || $_POST['titulo1'] == '' || empty($_FILES['img-carrusel1']['tmp_name'])) {
        $subida_correcta = 0;
        echo "<div class='alert alert-danger text-center lead my-0'>Ningun campo puede estar vacio</div>";
    }
    if ($_FILES['img-carrusel1']['size'] > '5120000') {
        return "<div class='alert alert-danger text-center lead my-0'>El archivo no puede ocupar más de <strong>5MB</strong></div>";
        $subida_correcta = 0;
    }
    if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
        echo "<div class='alert alert-warning text-center lead my-0'>Solo se admiten los formatos <strong>JPG, JPEG, PNG y GIF</strong></div>";
        $subida_correcta = 0;
    }
    if ($_POST['texto1'] == '' || $_POST['titulo1'] == '' || empty($_FILES['img-carrusel1']['tmp_name']) && $subida_correcta == 1) {
        echo "<div class='alert alert-warning text-center lead my-0'>Tu archivo no puede subirse</div>";
    } else {
        if (move_uploaded_file($_FILES['img-carrusel1']['tmp_name'], DIRECTORIO_RAIZ . "/subidas/carrusel/" . $_POST['idC'])) {
            echo "<div class='alert alert-success text-center my-0'>El archivo <strong>" . basename($_FILES['img-carrusel1']['name']) . "</strong> ha sido subido.</div>";
        } else {
            echo "<div class='alert alert-warning text-center lead my-0'><strong>Ha ocurrido un error.</strong></div>";
        }
        if (!in_array('2', $msj) ) {
            RepositorioCarrusel::insertar_datos_carrusel('2', $_POST['titulo1'], $_POST['texto1'], Conexion::obtener_conexion());
        } else {
            RepositorioCarrusel::actualizar_datos_carrusel('2', $_POST['titulo1'], $_POST['texto1'], Conexion::obtener_conexion());
        }
    }
}
if (isset($_POST['guardar_imagen2']) && !empty($_FILES['img-carrusel2']['tmp_name'])) {

    $directorio = DIRECTORIO_RAIZ . "/subidas/carrusel/";
    $carpeta_objetivo = $directorio . basename($_FILES['img-carrusel2']['name']);
    $subida_correcta = 1;
    $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);
    $comprobacion = getimagesize($_FILES['img-carrusel2']['tmp_name']);
    if ($comprobacion !== false) {
        $subida_correcta = 1;
    } else {
        $subida_correcta = 0;
    }
    if ($_POST['texto2'] == '' || $_POST['titulo2'] == '' || empty($_FILES['img-carrusel2']['tmp_name'])) {
        $subida_correcta = 0;
        echo "<div class='alert alert-danger text-center lead my-0'>Ningun campo puede estar vacio</div>";
    }
    if ($_FILES['img-carrusel2']['size'] > '5120000') {
        return "<div class='alert alert-danger text-center lead my-0'>El archivo no puede ocupar más de <strong>5MB</strong></div>";
        $subida_correcta = 0;
    }
    if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
        echo "<div class='alert alert-warning text-center lead my-0'>Solo se admiten los formatos <strong>JPG, JPEG, PNG y GIF</strong></div>";
        $subida_correcta = 0;
    }
    if ($_POST['texto2'] == '' || $_POST['titulo2'] == '' || empty($_FILES['img-carrusel2']['tmp_name']) && $subida_correcta == 1) {
        echo "<div class='alert alert-warning text-center lead my-0'>Tu archivo no puede subirse</div>";
    } else {
        if (move_uploaded_file($_FILES['img-carrusel2']['tmp_name'], DIRECTORIO_RAIZ . "/subidas/carrusel/" . $_POST['idC'])) {
            echo "<div class='alert alert-success text-center my-0'>El archivo <strong>" . basename($_FILES['img-carrusel2']['name']) . "</strong> ha sido subido.</div>";
        } else {
            echo "<div class='alert alert-warning text-center lead my-0'><strong>Ha ocurrido un error.</strong></div>";
        }
        if (!in_array('3', $msj)) {
            RepositorioCarrusel::insertar_datos_carrusel('3', $_POST['titulo2'], $_POST['texto2'], Conexion::obtener_conexion());
        } else {
            RepositorioCarrusel::actualizar_datos_carrusel('3', $_POST['titulo2'], $_POST['texto2'], Conexion::obtener_conexion());
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-borde mb-5">
                <div class="card-title">
                    <h2 class="display-5 text-center">Gestión del Carrusel</h2>
                </div>
                <div class="row mt-5">
                    <div class="col-md-7 text-center contenedor-img-carrusel">
                        <?php
                        if (file_exists(DIRECTORIO_RAIZ . '/subidas/carrusel/' . '1')) {
                            ?>
                            <img src="<?php echo SERVIDOR . '/subidas/carrusel/' . '1'; ?>" class="img-fluid rounded">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo IMG; ?>800x600.png" class="img-fluid rounded">
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-5 text-center align-self-start text-sign">
                        <div class="card card-borde mr-2">
                            <form action="<?php echo GESTOR_CARRUSEL; ?>" method="post" enctype="multipart/form-data">
                                <label for="titulo-carrusel">Titulo:</label>
                                <textarea id="titulo-carrusel" name="titulo0" class="form-control" rows="1"></textarea>
                                <label for="text-carrusel">Texto:</label>
                                <textarea id="text-carrusel" name="texto0" class="form-control" rows="2" ></textarea>
                                <br>
                                <label for="img-carrusel0" id="label-archivo-2"><i class="fa fa-upload"></i> Subir Imagen</label>
                                <input type="file" name="img-carrusel0" id="img-carrusel0" class="boton_subir">    
                                <input type="hidden" name="idC" value="1">   
                                <button type="submit" value="Guardar" name="guardar_imagen0" class="form-control label-archivo-3"><i class="fa fa-save"></i> Guardar</button> 
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-md-7 text-center contenedor-img-carrusel">
                        <?php
                        if (file_exists(DIRECTORIO_RAIZ . '/subidas/carrusel/' . '2')) {
                            ?>
                            <img src="<?php echo SERVIDOR . '/subidas/carrusel/' . '2'; ?>" class="img-fluid rounded">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo IMG; ?>800x600.png" class="img-fluid rounded">
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-5 text-center align-self-start text-sign">
                        <div class="card card-borde mr-2">
                            <form action="<?php echo GESTOR_CARRUSEL; ?>" method="post" enctype="multipart/form-data">
                                <label for="titulo-carrusel">Titulo:</label>
                                <textarea id="titulo-carrusel" name="titulo1" class="form-control" rows="1" ></textarea>
                                <label for="text-carrusel">Texto:</label>
                                <textarea id="text-carrusel" name="texto1" class="form-control" rows="2" ></textarea>
                                <br>
                                <label for="img-carrusel1" id="label-archivo-2"><i class="fa fa-upload"></i> Subir Imagen</label>
                                <input type="file" name="img-carrusel1" id="img-carrusel1" class="boton_subir">    
                                <input type="hidden" name="idC" value="2">   
                                <button type="submit" value="Guardar" name="guardar_imagen1" class="form-control label-archivo-3"><i class="fa fa-save"></i> Guardar</button> 
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-7 text-center contenedor-img-carrusel">
                        <?php
                        if (file_exists(DIRECTORIO_RAIZ . '/subidas/carrusel/' . '3')) {
                            ?>
                            <img src="<?php echo SERVIDOR . '/subidas/carrusel/' . '3'; ?>" class="img-fluid rounded">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo IMG; ?>800x600.png" class="img-fluid rounded">
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-5 text-center align-self-start text-sign">
                        <div class="card card-borde mr-2">
                            <form action="<?php echo GESTOR_CARRUSEL; ?>" method="post" enctype="multipart/form-data">
                                <label for="titulo-carrusel">Titulo:</label>
                                <textarea id="titulo-carrusel" name="titulo2" class="form-control" rows="1" ></textarea>
                                <label for="text-carrusel">Texto:</label>
                                <textarea id="text-carrusel" name="texto2" class="form-control" rows="2" ></textarea>
                                <br>
                                <label for="img-carrusel2" id="label-archivo-2"><i class="fa fa-upload"></i> Subir Imagen</label>
                                <input type="file" name="img-carrusel2" id="img-carrusel2" class="boton_subir">    
                                <input type="hidden" name="idC" value="3">   
                                <button type="submit" value="Guardar" name="guardar_imagen2" class="form-control label-archivo-3"><i class="fa fa-save"></i> Guardar</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'plantillas/declaracion_cierre.inc.php';
