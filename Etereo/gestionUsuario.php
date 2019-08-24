<?php
function alta_usuario($conexion,$usuario) {
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
    // RECUERDA EL TRY/CATCH
    try {
        $consulta = "CALL INSERTAR_CLIENTE(:cif,:nombre,:direccion,:correoElectronico,:contraseña,:telCliente)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':cif',$usuario["cif"]);
        $stmt->bindParam(':nombre',$usuario["nombre"]);
        $stmt->bindParam(':direccion',$usuario["direccion"]);
        $stmt->bindParam(':correoElectronico',$usuario["correoElectronico"]);
        $stmt->bindParam(':contraseña',$usuario["contraseña"]);
        $stmt ->bindParam(':telCliente',$usuario["telCliente"]);
        $stmt->execute();
        return true;
    }catch(PDOException $e){
        return false;
    }
}
/* PARA CONSULTAR LOS DATOS DE LOS USUARIOS */
function consultarUsuarios($conexion){
    try{
        $consulta = ("SELECT * FROM CLIENTES");
        $stmt = $conexion -> prepare($consulta);
        $stmt -> execute();
        return $stmt; 
    }catch(PDOException $e){
        return false;
    }
}
    /*ESTA FUNCION NOS PERMITE CONSULTAR UN USUARIO */
function consultaUsuario($conexion,$correoElectronico,$contraseña){
        $consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE CORREOELECTRONICO=:correoElectronico AND CONTRASEÑA=:contraseña";
        //Utiliza el metodo prepare del objeto PDO
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':correoElectronico',$correoElectronico);
        $stmt -> bindParam(':contraseña',$contraseña);
        $stmt -> execute();
        //Retornar el resultado del metodo fetchcolumn
        return $stmt -> fetchColumn();
    }
function consultarSiAdministrador($conexion,$correoElectronico,$pass) {
    $consulta = "SELECT ADMINISTRADOR FROM CLIENTES"
        . " WHERE (CLIENTES.CORREOELECTRONICO = '".$correoElectronico."' AND CLIENTES.CONTRASEÑA = '".$pass."')";
    return $conexion->query($consulta);
}
function consultarOID_CLI($conexion,$correoElectronico) {
    $consulta = "SELECT OID_CLI FROM CLIENTES"
        . " WHERE (CLIENTES.CORREOELECTRONICO = '".$correoElectronico."')";
    return $conexion->query($consulta);
}
function modificarUsuario($conexion,$cif,$nombre,$direccion,$correoElectronico,$contraseña,$telefono){
    try{
        $stmt=$conexion->prepare('CALL ACTUALIZAR_CLIENTE(:cif,:nombre,:direccion,:correoElectronico,:contraseña,:telCliente)');
        $stmt -> bindParam(':cif',$cif);
        $stmt -> bindParam(':nombre',$nombre);
        $stmt -> bindParam(':direccion',$direccion);
        $stmt -> bindParam(':correoElectronico',$correoElectronico);
        $stmt -> bindParam(':contraseña',$contraseña);
        $stmt -> bindParam(':telCliente',$telefono);
        $stmt -> execute();
        return true;
    }catch(PDOException $e){
        return false;
    }
}
function eliminarCliente($conexion,$correoElectronico){
    try{
        $stmt = $conexion->prepare('CALL BORRAR_CLIENTE(:correoElectronico)');
        $stmt -> bindParam(':correoElectronico',$correoElectronico);
        $stmt -> execute();
        return "";
    }catch(PDOException $e){
        return false;
    }
}
?>