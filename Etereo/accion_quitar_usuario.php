<?php	
	session_start();	
	require_once("gestionBD.php");
	require_once('gestionUsuario.php');
	if (isset($_SESSION["usuario"])) {
		$usuario = $_SESSION["usuario"];
		unset($_SESSION["usuario"]);
		
		
		
		
		$conexion = crearConexionBD();		
		$excepcion = eliminarCliente($conexion,$usuario['CORREOELECTRONICO']);
		cerrarConexionBD($conexion);
			
		if ($excepcion) {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "adminPage.php?var2=" . $_GET["var2"];
			Header("Location: adminPage.php?var2=" . $_SESSION['login']);
		}
		else Header("Location: adminPage.php?var2=" . $_SESSION['login']);
	}
	else Header("Location: vistaAdminCurso.php?var2=" . $_GET["var2"]); // Se ha tratado de acceder directamente a este PHP
?>