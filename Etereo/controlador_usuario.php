<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="utf-8">
  <title>Gestión de Clientes: Alta de Cliente realizada con éxito</title>
  <link rel="icon" type="image/vnd.microsoft.icon" href="assets/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/style.css"  media="screen"/>
</head>
<?php	
	session_start();
	require_once("gestionBD.php");
	require_once("gestionUsuario.php");
	$conexion = crearConexionBD();
	
	if (isset($_REQUEST["OID_CLI"])){
		$usuario["OID_CLI"] = $_REQUEST["OID_CLI"];
		$usuario["CIF"] = $_REQUEST["CIF"];
		$usuario["NOMBRE"] = $_REQUEST["NOMBRE"];
		$usuario["DIRECCION"] = $_REQUEST["DIRECCION"];
		$usuario["CORREOELECTRONICO"] = $_REQUEST["CORREOELECTRONICO"];
		$usuario["CONTRASEÑA"] = $_REQUEST["CONTRASEÑA"];
		$usuario["TELEFONO"] = $_REQUEST["TELEFONO"];

		$_SESSION["usuario"] = $usuario;
		if(alta_usuario($conexion, $usuario)){
		
		if (isset($_REQUEST["editar"])) Header("Location: adminPage.php?var2=" .$usuario["OID_CLI"]); 
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_actualizar_usuario.php?var2=" .$usuario["OID_CLI"]);
		else if (isset($_REQUEST["borrar"]))  Header("Location: accion_quitar_usuario.php?var2=" .$usuario["OID_CLI"]); 
		}else { ?>
			<div class="body-error">
        			<div class="mensaje-error">
				<div style="margin-top: 15%;"><h1 id="mensaje-error" >El usuario <?php echo $usuario["CIF"] ?> ya existe en la base de datos.</h1></div>
				<div class="boton-error">
            		<button id="boton-error" style="margin-top: 85%;"><a id="mensaje-boton-error" href="adminPage.php?var2=admin@admin.com">Prueba otros datos</a></button>
        		</div>
		<?php }
	}
	else {
		Header("Location: error.php?var2=" .$_REQUEST["OID_CLI"]);
	}?>