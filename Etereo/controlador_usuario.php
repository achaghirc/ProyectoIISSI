<?php	
	session_start();
	
	if (isset($_REQUEST["OID_CLI"])){
		$usuario["OID_CLI"] = $_REQUEST["OID_CLI"];
		$usuario["CIF"] = $_REQUEST["CIF"];
		$usuario["NOMBRE"] = $_REQUEST["NOMBRE"];
		$usuario["DIRECCION"] = $_REQUEST["DIRECCION"];
		$usuario["CORREOELECTRONICO"] = $_REQUEST["CORREOELECTRONICO"];
		$usuario["CONTRASEÑA"] = $_REQUEST["CONTRASEÑA"];
		$usuario["TELEFONO"] = $_REQUEST["TELEFONO"];

		$_SESSION["usuario"] = $usuario;
		
		if (isset($_REQUEST["editar"])) Header("Location: adminPage.php?var2=" .$usuario["OID_CLI"]); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_actualizar_usuario.php?var2=" .$usuario["OID_CLI"]);
		else if (isset($_REQUEST["borrar"]))  Header("Location: accion_quitar_usuario.php?var2=" .$usuario["OID_CLI"]); 

	}
	else {
		Header("Location: error.php?var2=" .$_REQUEST["OID_CLI"]);
	}