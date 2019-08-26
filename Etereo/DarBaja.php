<?php		
require_once("gestionBD.php");
require_once("gestionUsuario.php");
$conexion = crearConexionBD();
		
	session_start();
        $email = $_SESSION["login"];
        $baja = eliminarCliente($conexion, $email);
    session_destroy();
    Header("Location: index.php");


?>
