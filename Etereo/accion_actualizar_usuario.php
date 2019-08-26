<?php
    session_start();

        require_once ("gestionBD.php");
        require_once ("gestionUsuario.php");

	if (isset($_SESSION["usuario"])) {

		$usuario = $_SESSION["usuario"];		
			
    	$conexion = crearConexionBD();
   
		$excepcion = modificarUsuario($conexion,$usuario["CIF"],$usuario["NOMBRE"],$usuario["DIRECCION"],
		$usuario["CORREOELECTRONICO"],$usuario["CONTRASEÑA"],$usuario["TELEFONO"]);
  
		cerrarConexionBD($conexion);
		if ($excepcion) {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "adminPage.php?var2=" . $_REQUEST['CIF'];
			Header("Location: adminPage.php?var2=" . $_SESSION['login']);
		}
		else{
			Header("Location: adminPage.php?var2=" . $_REQUEST['CIF']);
		}
	} 
	 else {
		Header("LOCATION:form_actualizar_usuario.php?var2=" . $_REQUEST['CIF']);
}


cerrarConexionBD($conexion);

?>