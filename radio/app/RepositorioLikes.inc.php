<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

class RepositorioLikes {

    public static function insertar_like($autor_id, $entrada_id, $conexion) {
        $meGusta = false;
        if ($conexion) {
            try {
                $sql = "INSERT INTO likes(autor_id, entrada_id) VALUE (:autor_id, :entrada_id)";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $autor_id, PDO::PARAM_STR);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);

                $meGusta = $sentencia->execute();
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $meGusta;
    }

    public static function obtener_total_likes($conexion){
        $total_likes = '0';
        if($conexion){
            try {
                $sql = "SELECT COUNT(*) AS total FROM likes";
                
                $sentencia = $conexion->prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_likes = $resultado['total'];
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
        return $total_likes;
    }

    public static function obtener_cantidad_likes_entrada($entrada_id, $conexion){
        $cantidad_likes = '0';
        if($conexion){
            try {
                $sql = "SELECT COUNT(*) AS total FROM likes WHERE (entrada_id = :entrada_id)";
                
                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $cantidad_likes = $resultado['total'];
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
        return $cantidad_likes;
    }
    
    public static function obtener_entradas_con_like($conexion){
        $entradasConLike = '0';
        if($conexion){
            try{
                $sql = "SELECT  COUNT(DISTINCT entrada_id) AS total FROM likes";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $entradasConLike = $resultado['total'];
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
        return $entradasConLike;
    }


    public static function comprobar_like_usuario_entrada($autor_id, $entrada_id, $conexion){
        $voto = false;
        if($conexion){
            try {
                $sql = "SELECT COUNT(entrada_id) AS total FROM likes WHERE (autor_id = :autor_id AND entrada_id = :entrada_id)";
               
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $autor_id, PDO::PARAM_STR);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch(); 
                $voto = $resultado['total'];
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            } 
        }
        return $voto;
    }

}
