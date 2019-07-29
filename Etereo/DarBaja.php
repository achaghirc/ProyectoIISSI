<?php		
require_once("gestionBD.php");
require_once("gestionUsuario.php");
$conexion = crearConexionBD();
session_start();

        $email = $_SESSION["login"];
        $baja = eliminarCliente($conexion, $email);
        session_destroy();
        Header("Location: coverPage.php");





/*  session_start();	
	require_once("gestionBD.php");
    require_once('gestionUsuario.php');
    $email = $_SESSION['login'];
	if (isset($_SESSION["usuario"])) {
		$usuario = $_SESSION["usuario"];
		unset($_SESSION["usuario"]);
		
		
		
		
		$conexion = crearConexionBD();		
		$excepcion = eliminarCliente($conexion,$email);
        cerrarConexionBD($conexion);

        if ($excepcion) {
			$_SESSION["login"] = $excepcion;
			$_SESSION["destino"] = "shopping-page.php";
			Header("Location: coverPage.php");
		}
		else Header("Location: coverPage.php");
	}
	else Header("Location: coverPage.php"); */ 
?>
