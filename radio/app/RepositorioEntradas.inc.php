<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/Redireccion.inc.php';

class RepositorioEntradas {

    public static function insertar_entrada($conexion, $entrada) {
        $entrada_insertada = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO entradas(autor_id, url, titulo, texto, fecha, activa) VALUES(:autor_id, :url, :titulo, :texto, NOW(), :activa)";

                $activa = '0';
                
                if($entrada -> obtener_activo()){
                    $activa = '1';
                }
                
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $entrada->obtener_autor_id(), PDO::PARAM_STR);
                $sentencia->bindParam(':url', $entrada->obtener_url(), PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $entrada->obtener_titulo(), PDO::PARAM_STR);
                $sentencia->bindPAram(':texto', $entrada->obtener_texto(), PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activa, PDO::PARAM_STR);
                
                $entrada_insertada = $sentencia->execute();
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $entrada_insertada;
    }
    
    public static function obtener_total_entradas($activa, $conexion){
        $total_entradas = null;
        if($conexion){
            try{
                $sql = "SELECT COUNT(*) as total FROM entradas WHERE activa = :activa";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':activa', $activa, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_entradas = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
    return $total_entradas;    
    }

    public static function obtener_entradas_fecha_descendente($conexion) {
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE activa= '1' ORDER BY fecha DESC LIMIT 7";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new Entradas(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entradas;
    }
    
    public static function obtener_entradas_usuario_fecha_descendente($conexion, $id_usuario) {
        $entradas_obtenidas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios' ";
                $sql .= "FROM entradas a ";
                $sql .= "LEFT JOIN comentarios b ON a.id = b.entrada_id ";
                $sql .= "WHERE a.autor_id = :autor_id ";
                $sql .= "GROUP BY a.id ";
                $sql .= "ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':autor_id', $id_usuario,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(
                            new Entradas(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                            ),
                            $fila['cantidad_comentarios']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entradas_obtenidas;
    }

    
    public static function obtener_todas_entradas_fecha_descendente($conexion) {
        $entradas_obtenidas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios' ";
                $sql .= "FROM entradas a ";
                $sql .= "LEFT JOIN comentarios b ON a.id = b.entrada_id ";
                $sql .= "GROUP BY a.id ";
                $sql .= "ORDER BY a.fecha DESC";

                $sentencia = $conexion->prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas_obtenidas[] = array(
                            new Entradas(
                                $fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                            ),
                            $fila['cantidad_comentarios']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entradas_obtenidas;
    }
    
    
    public static function obtener_por_url($url, $conexion) {
        $entrada = null;

        if (isset($conexion)) {
            try {

                $sql = "SELECT * FROM entradas WHERE url LIKE :url";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entrada = new Entradas(
                            $resultado['id'], $resultado['autor_id'], $resultado['url'], 
                            $resultado['titulo'], $resultado['texto'], $resultado['fecha'], 
                            $resultado['activa']
                    );
                } else {
                    Redireccion::redirigir(ERROR404);
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entrada;
    }
    
    public static function obtener_entrada_por_id($conexion, $id) {
        $entrada = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas WHERE id = :id";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entrada = new Entradas(
                            $resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']
                    );
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $entrada;
    }
    
    public function actualizar_entrada($conexion, $id, $titulo, $url, $texto, $activo){
        $actualizacion_correcta = false;
        
        if(isset($conexion)){
            try {
                $sql = "UPDATE entradas SET titulo =  :titulo, url = :url, texto = :texto, activa = :activa WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia -> bindParam(':activa', $activo, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                
                if(count($resultado)){
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
            return $actualizacion_correcta;
        }
    }
    
     public static function url_existe($conexion, $url){
        $url_existe = true;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM entradas WHERE url = :url";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    $url_existe = true;
                } else {
                    $url_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }      
        }
        return $url_existe;
    }
    
    public static function titulo_existe($conexion, $titulo){
        $titulo_existe = true;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM entradas WHERE titulo = :titulo";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    $titulo_existe = true;
                } else {
                    $titulo_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }      
        }
        return $titulo_existe;
    }
    
     public static function eliminar_comentarios_y_entradas($conexion, $entrada_id){
        if(isset($conexion)){
            try {
                $conexion -> beginTransaction();
                
                $sql1 = "DELETE FROM comentarios WHERE entrada_id = :entrada_id";
                $sentencia1 = $conexion -> prepare($sql1);
                $sentencia1 -> bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia1 -> execute();
                
                $sql2 = "DELETE FROM entradas WHERE id = :entrada_id";
                $sentencia2 = $conexion -> prepare($sql2);
                $sentencia2 -> bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia2 -> execute();
                
                $conexion -> commit();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
                $conexion -> rollBack();
            }      
        }
  
    }

    public static function obtener_entradas_azar($cantidad, $conexion) {
        $entradas = [];
        
        if(isset($conexion)){
            try{
                $sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT $cantidad";
        
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
        
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
    			$entradas [] = new Entradas($fila['id'], $fila['autor_id'], $fila['url'], 
                                $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                        );
                    }
    		}
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
        return $entradas;
    }
    
    public static function sumar_like($like, $conexion){
        if($conexion){
            try{
                $sql = "INSERT INTO likes ";
                
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
    }

}
