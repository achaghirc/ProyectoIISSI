<?php	
	session_start();
	
	if (isset($_REQUEST["CIF"])){
		$usuario["CIF"] = $_REQUEST["CIF"];
		$usuario["NOMBRE"] = $_REQUEST["NOMBRE"];
		$usuario["DIRECCION"] = $_REQUEST["DIRECCION"];
		$usuario["CORREOELECTRONICO"] = $_REQUEST["CORREOELECTRONICO"];
		$usuario["CONTRASEÑA"] = $_REQUEST["CONTRASEÑA"];
		$usuario["TELEFONO"] = $_REQUEST["TELEFONO"];

		$_SESSION["usuario"] = $usuario;
		
		if (isset($_REQUEST["editar"])) Header("Location: adminPage.php?var2=" .$_REQUEST["CIF"]); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_actualizar_usuario.php?var2=" .$_REQUEST["CIF"]);
		else /* if (isset($_REQUEST["borrar"])) */ Header("Location: accion_quitar_usuario.php?var2=" .$_REQUEST["CIF"]); 

	}
	else {
		Header("Location: error.php?var2=" .$_REQUEST["CIF"]);
	}