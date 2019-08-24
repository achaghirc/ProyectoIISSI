<?php
function consultarTodosProductos($conexion) {
	try{
        $consulta = "SELECT * FROM PRODUCTOS";
        return $conexion -> query($consulta);
        }catch(PDOException $e){
            return false;
        }
}

function modificarProducto($conexion,$identificador,$nombre,$descripcion,$precio){
    try {
        $stmt = $conexion->prepare('CALL ACTUALIZAR_PRODUCTO(:identificador,:nombre,:descripcion,:precio)');
        $stmt -> bindParam(':identificador', $identificador);
        $stmt -> bindParam(':nombre',$nombre);
        $stmt -> bindParam(':descripcion',$descripcion);
        $stmt -> bindParam(':precio',$precio);
        $stmt -> execute();
        return true;
    }catch(PDOException $e){
        return false;
    }
}

?>