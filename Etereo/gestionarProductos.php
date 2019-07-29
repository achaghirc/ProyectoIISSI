<?php
function consultarTodosProductos($conexion) {
	try{
        $consulta = "SELECT * FROM productos";
        return $conexion -> query($consulta);
        }catch(PDOException $e){
            $_SESION['excepcion'] = $e->getMessage();
            echo $e->getMessage();
            Header("Location:excepcion.php");
        }
}
?>