<?php

class RepositorioCarrusel{
    
    public static function insertar_datos_carrusel($id, $titulo, $texto, $conexion){
        $carrusel_insertado = false;
        if($conexion){
            try {
                $sql = "INSERT INTO carrusel(id, titulo, texto) VALUES(:id, :titulo, :texto)";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $texto, PDO::PARAM_STR);
                
                $carrusel_insertado =$sentencia -> execute();
                } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
        return $carrusel_insertado;
    }
    
    public static function obtener_todos_datos_carrusel($conexion){
        $carrusel = [];
        if($conexion){
            try {
                $sql = "SELECT * FROM carrusel";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach ($resultado as $fila){
                    $carrusel[] = new Carrusel($fila['id'], $fila['titulo'], $fila['texto']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
        return $carrusel;
    }
    
    public static function obtener_datos_carrusel($id, $conexion){
        $carrusel = [];
        if($conexion){
            try {
                $sql = "SELECT * FROM carrusel WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach ($resultado as $fila){
                    $carrusel[] = new Carrusel($fila['id'], $fila['titulo'], $fila['texto']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
        return $carrusel;
    }
    
    public static function actualizar_datos_carrusel($id, $titulo, $texto, $conexion){
        $carrusel_actualizado = false;
        if($conexion){
            try{
                $sql = "UPDATE carrusel SET titulo = :titulo, texto = :texto WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                
                if(count($resultado)){
                    $carrusel_actualizado = true;
                } else {
                    $carrusel_actualizado = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
        return $carrusel_actualizado;
    }
    
}
