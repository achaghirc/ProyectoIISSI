<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="utf-8">
  <title>Gestión de Clientes: Alta de Cliente realizada con éxito</title>
  <link rel="icon" type="image/vnd.microsoft.icon" href="assets/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/style.css"  media="screen"/>
</head>

<body style="margin: unset; background-color:aliceblue;">
	<?php
		include_once("cabecera.php");
		
    //Hay que implementar la libreria de la conexion a BD
    require_once("gestionBD.php");
    //Hay que implementar la libreria del CRUD de usuarios
	require_once("gestionUsuario.php");
    //Comprobar si existe la sesion con los datos del formulario ya validados
    //Recoger los datos y anular los datos de la sesion (formulario y errores)
    //En otro caso hay que derivar el formulario
    if(isset($_SESSION["formulario"])){
        $formulario = $_SESSION["formulario"];
        unset($_SESSION["formulario"]);
        unset($_SESSION["errores"]);
    }else{
        Header("Location:form_alta_usuario.php");
    }
    //Abrir conexion con la base de datos
    $conexion = crearConexionBD();
	?>
	<main>
		<!-- CONSULTAR EL TEMA DE TEORÍA SOBRE ACCESO A DATOS -->
		<?php 	// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
				// EN EL CONTEXTO DE UNA SENTENCIA IF
			if (alta_Usuario($conexion, $formulario)) {
		?>
				<!-- MENSAJE DE BIENVENIDO AL USUARIO -->
			<div class="mensaje_bienvenida">
				<h1 id="mensajeBienvenida">Hola <?php echo $formulario["cif"] ?>, gracias por registrarte</h1>
				<p>Pulsa <a href="form_alta_usuario.php">aquí</a> para iniciar sesion.</p>
			</div>
		<?php } else { ?>
				<!-- MENSAJE DE QUE USUARIO YA EXISTE -->
				
				<div class="body-error">
        			<div class="mensaje-error">
				<div style="margin-top: 15%;"><h1 id="mensaje-error" >El usuario <?php echo $formulario["cif"] ?> ya existe en la base de datos.</h1></div>
				<div class="boton-error">
            		<button id="boton-error" style="margin-top: 79%;"><a id="mensaje-boton-error" href="form_alta_usuario.php">prueba otros datos</a></button>
        		</div>
		<?php } ?>
	</main>

</body>
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>