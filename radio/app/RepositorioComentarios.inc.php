<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Comentarios.inc.php';

class RepositorioComentarios {

    public static function insertar_comentario($conexion, $comentario) {
        $comentario_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES (:autor_id, :entrada_id, :titulo, :texto, NOW())";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':autor_id', $comentario->obtener_autor_id(), PDO::PARAM_STR);
                $sentencia->bindParam(':entrada_id', $comentario->obtener_entrada_id(), PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $comentario->obtener_titulo(), PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $comentario->obtener_texto(), PDO::PARAM_STR);

                $comentario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $comentario_insertado;
    }

    public static function obtener_cantidad_comentarios($entrada_id, $conexion) {
        $total_comentarios = '0';

        if (isset($conexion)) {
            try {
                if($entrada_id){
                    $sql = "SELECT COUNT(*) as total FROM comentarios WHERE entrada_id = :entrada_id";
                } else {
                    $sql = "SELECT COUNT(*) as total FROM comentarios";
                }

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $total_comentarios = $resultado['total'];
                } else {
                    $total_comentarios = '0';
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $total_comentarios;
    }

    public static function obtener_comentarios_usuario($id_usuario, $conexion){
        $comentarios_usuario = [];
        if($conexion){
            try{
                $sql = "SELECT * FROM comentarios WHERE autor_id = :autor_id";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach ($resultado as $fila){
                        $comentarios_usuario[] = new Comentarios($fila['id'], $fila['autor_id'], $fila['entrada_id'], 
                                $fila['titulo'], $fila['texto'], $fila['fecha']);
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
        return $comentarios_usuario;
    }

        public static function obtener_comentarios_usuario_fecha_descendente($conexion, $id_usuario, $cantidad) {
        $comentarios_obtenidas = [];

        if (isset($conexion)) {
            try {
                if(!$cantidad){
                    $sql = "SELECT a.id, a.entrada_id, a.autor_id, a.titulo, a.texto, a.fecha, b.nombre AS 'usuario' ";
                    $sql .= " FROM comentarios a ";
                    $sql .= " LEFT JOIN usuarios b ON a.autor_id = b.id";
                    $sql .= "  GROUP BY a.id ";
                    $sql .= "  ORDER BY a.fecha DESC";
                } else {
                    $sql = "SELECT a.id, a.entrada_id, a.autor_id, a.titulo, a.texto, a.fecha, b.nombre AS 'usuario' ";
                    $sql .= " FROM comentarios a ";
                    $sql .= " LEFT JOIN usuarios b ON a.autor_id = b.id";
                    $sql .= "  GROUP BY a.id ";
                    $sql .= "  ORDER BY a.fecha DESC LIMIT $cantidad";
                }
                
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios_obtenidas[] = array(
                            new Entradas(
                                $fila['id'], $fila['entrada_id'], $fila['autor_id'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['0']
                            ),
                            $fila['usuario']
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $comentarios_obtenidas;
    }

    public static function eliminar_comentarios($conexion, $comentario_id) {
        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();

                $sql1 = "DELETE FROM comentarios WHERE id = :comentario_id";
                $sentencia1 = $conexion->prepare($sql1);
                $sentencia1->bindParam(':comentario_id', $comentario_id, PDO::PARAM_STR);
                $sentencia1->execute();

                $conexion->commit();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
                $conexion->rollBack();
            }
        }
    }

}
