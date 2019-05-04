<?php
include_once 'Usuario.inc.php';

class RepositorioUsuario {

    public static function insertar_usuario($conexion, $usuario) {      
        $usuario_insertado = false;

        if (isset($conexion)) {
            try { 
                $sql = "INSERT INTO usuarios(nombre, email, password, fecha_registro, tipo, activo) VALUES(:nombre, :email, :password, NOW(), :tipo, 0)";

                $sentencia = $conexion->prepare($sql);
                
                $sentencia->bindParam(':nombre', $usuario-> obtener_nombre(), PDO::PARAM_STR);
                $sentencia->bindParam(':email', $usuario-> obtener_email(), PDO::PARAM_STR);
                $sentencia->bindParam(':password', $usuario-> obtener_password(), PDO::PARAM_STR);
                $sentencia->bindParam(':tipo', $usuario-> obtener_tipo(), PDO::PARAM_STR);

                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print "ERROR " . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }
    
    public static function obtener_total_usuarios($conexion){
        $total_usuarios = null;    
        if($conexion){
            try{
                $sql = "SELECT COUNT(*) as total FROM usuarios";

                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch(); 

                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
        return $total_usuarios;     
    }
    
        public static function obtener_tipos_de_usuarios($tipo, $conexion){
        $total_usuarios_tipo = null;    
        if($conexion){
            try{
                $sql = "SELECT COUNT(*) as total FROM usuarios WHERE tipo = :tipo";

                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':tipo', $tipo, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch(); 
                $total_usuarios_tipo = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex -> getMessage();
            }
        }
        return $total_usuarios_tipo; 
    }

    public static function nombre_existe($conexion, $nombre) {
        $nombre_existe = true;

        if (isset($conexion)) {
            try {
                
                $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $nombre_existe = true;
                } else {
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print "ERROR " . $ex->getMessage();
            }
        }
        return $nombre_existe;
    }

    public static function email_existe($conexion, $email) {
        $email_existe = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if(count($resultado)){
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print "ERROR " . $ex->getMessage();
            }
        }
        return $email_existe;
    }
    
    public static function obtener_usuario_email($email, $conexion) {
        $usuario = null;
        
        if(isset($conexion)){
            try{ 
                include_once 'app/Usuario.inc.php';
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'],
                            $resultado['email'], $resultado['password'],
                            $resultado['fecha_registro'], $resultado['tipo'],
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print "ERROR: " . $ex ->getMessage();
            }
        }
        return $usuario;
    }
    
    public static function obtener_usuario_id($id, $conexion) {
        $usuario = null;
        
        if(isset($conexion)){
            try{ 
                include_once 'app/Usuario.inc.php';
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                
                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){
                    $usuario = new Usuario($resultado['id'], $resultado['nombre'],
                            $resultado['email'], $resultado['password'],
                            $resultado['fecha_registro'], $resultado['tipo'], $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex ->getMessage();
            }
        }
        return $usuario;
    }
    
    public function actualizar_nombre_por_id($conexion, $id, $nombre){
        $actualizacion_correcta = false;
        
        if(isset($conexion)){
            try {
                $sql = "UPDATE usuarios SET nombre = :nombre WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                
                if(count($resultado)){
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
      return $actualizacion_correcta;
    }
    
    public function actualizar_clave_por_id($conexion, $id, $password){
        $actualizacion_correcta = false;
        
        if(isset($conexion)){
            try {
                $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':password', $password, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                
                if(count($resultado)){
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
      return $actualizacion_correcta;
    }
    
    public static function obtener_usuario_fecha_descendente($conexion, $id, $cantidad){
         $usuarios_obtenidas = [];

        if (isset($conexion)) {
            try {
                if(!$cantidad){
                    $sql = "SELECT id, nombre, email, password, fecha_registro, tipo, activo";
                    $sql .= " FROM usuarios ";
                    $sql .= " ORDER BY fecha_registro DESC";
                } else {
                    $sql = "SELECT id, nombre, email, password, fecha_registro, tipo, activo";
                    $sql .= " FROM usuarios ";
                    $sql .= "ORDER BY fecha_registro DESC LIMIT $cantidad";
                }

                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
               
                $sentencia -> execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $usuarios_obtenidas[] = array(
                            new Usuario(
                                $fila['id'], $fila['nombre'], $fila['email'], $fila['password'], $fila['fecha_registro'], $fila['tipo'], $fila['activo']
                            )
                        );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuarios_obtenidas;
    }
    
    public function cambiar_activo_usuario($conexion, $id, $activo1){
        $actualizacion_correcta = false;
         if($activo1){
            $activo = 0;
        }else{
             $activo = 1;
         }
         
        if(isset($conexion)){
            try {
                $sql = "UPDATE usuarios SET activo = :activo WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':activo', $activo, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                
                if(count($resultado)){
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
      return $actualizacion_correcta;
    }
    
    public static function actualizar_permiso_usuario($id, $tipo, $conexion){
        $permiso_otrorgado = false;
        
        if ($tipo === 'Miembro') {
            $nivel = '0';
        } else if ($tipo === '2') {
            $nivel = '1';
        } else if ($tipo === '3'){
            $nivel = '2';
        }
        
        if($conexion){
            try{
                $sql = "UPDATE usuarios SET tipo = :nivel WHERE(id = :id)";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> bindParam(':nivel', $nivel, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                if(count($resultado)){
                    $permiso_otrorgado = true;
                } else {
                    $permiso_otrorgado = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex ->getMessage();
            }
        }
        return $permiso_otrorgado;
    }


    public static function obtener_cantidad_comentario_usuario($conexion, $id) {
        $cantidad = 0;
        
        if(isset($conexion)){
            try{ 
                $sql = "SELECT COUNT(id) AS 'cantidad_comentarios' FROM comentarios WHERE autor_id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $cantidad =  $fila['cantidad_comentarios'];
                    }
                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex ->getMessage();
            }
        }
        return $cantidad;
    }
}