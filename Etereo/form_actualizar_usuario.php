<?php
        session_start();
        require_once("gestionBD.php");
        require_once("gestionUsuario.php");
        //Si no existen datos del formulario en la sesion, se crea una 
        //entrada con los valores por defecto
        if(isset($_REQUEST['OID_CLI'])){
            $usuario['OID_CLI']=$_REQUEST['OID_CLI'];
            $usuario['CIF']=$_REQUEST['CIF'];
            $usuario['NOMBRE']=$_REQUEST['NOMBRE'];
            $usuario['DIRECCION']=$_REQUEST['DIRECCION'];
            $usuario['CORREOELECTRONICO']=$_REQUEST['CORREOELECTRONICO'];
            $usuario['CONTRASEÑA']=$_REQUEST['CONTRASEÑA'];
            $usuario['TELEFONO']=$_REQUEST['TELEFONO'];

            $_SESSION['usuario'] = $usuario;
        }
        /*Si ya existian valores los cogemos para inicializar el formulario *
        /*Si hay errores de validacion, hay que mostrarlos y marcar los campos */
        if(isset($_SESSION["errores"]))
            $errores = $_SESSION["errores"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
   <!-- <link rel="stylesheet" type="text/css" href="style.css">-->
    <div class="title">
        <title>Actualiza</title>
    </div>
    <link rel="stylesheet" type="text/css" href="css/form_alta_usuario.css"/>
    <link rel="stylesheet" type="text/css" href="css/prueba.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/validacionEditaUsuario.js" type="text/javascript"></script>
        <?php 
            $oid_cliente = $_REQUEST['OID_CLI'];
        ?>
</head>
<body>
<script>
		// Inicialización de elementos y eventos cuando el documento se carga completamente
		$(document).ready(function() {
			$("#editaUsuario").on("submit", function() {
				return validateEdition();
            });

				validateCif();            

				validateName();
            
				validateDirection();

				validateEmail();

				validateTel();

        });
    </script>
    <?php
      include_once("gestionUsuario.php");
      include_once("gestionBD.php");
      
      $conexion=crearConexionBD();
      $email = $_SESSION['login'];
      $pass = $_SESSION['pass'];
      $esAdmin = consultarSiAdministrador($conexion,$email,$pass);
      $custrow= $esAdmin -> Fetch(PDO::FETCH_ASSOC);
      cerrarConexionBD($conexion);

          if($custrow['ADMINISTRADOR'] == "YES"){
              include_once("cabeceraAdmin.php");
          }else if($custrow['ADMINISTRADOR'] == "NO"){
              include_once("cabecera2.php");
          }else{
              include_once("cabecera.php");
          }
    ?>
    <?php 
        // Mostrar los erroes de validación (Si los hay)
        if(isset($errores) && count($errores) > 0){
            echo "<div id=\"div_errores\" class=\"error\">";
                echo "<h4>Errores en el formulario:</h4>";
                foreach($errores as $error) echo $error;
                echo "</div>";
        }
		
    ?>
                <div style="padding: 0% 30%;">
                <form id="actualizaUsuario" method="post" action="controlador_usuario.php"  class="formulario" >
                        <div class="informacion">
                            <p>
                                <i>Elige los campos a editar para el usuario</i>
                            </p> 
                        </div>
                 <h1 class="titulo_formulario">Actualiza</h1>
                    
                    <input id="OID_CLI" name="OID_CLI" class="input-css" type="hidden" size="40" value="<?php echo $usuario['OID_CLI'];?>"/>

                    <label for="cif" class="label-css">CIF: </label>
                    <input id="CIF" name="CIF" class="input-css" type="string" size="40" value="<?php echo $usuario['CIF'];?>"  required oninput="validateCif();"/>
                     
                    <label for="nom" class="label-css">Nombre Empresa:</label>
                    <input id="NOMBRE" name="NOMBRE" class="input-css" type="text" value="<?php echo $usuario['NOMBRE']?>" required oninput="validateName();">
                    
                    <label for="direc" class="label-css">Direccion:</label>
                    <input id="DIRECCION" name="DIRECCION" class="input-css" type="text" value="<?php echo $usuario['DIRECCION'];?>"  required oninput="validateDirection();"/>
                    
                    <label for="correoElec" class="label-css">Correo Electronico: </label>
                    <input id="CORREOELECTRONICO" name="CORREOELECTRONICO"class="input-css" type="text" size="40" value="<?php echo $usuario['CORREOELECTRONICO'];?>" required oninput="validateEmail();"/>
                    
                    <label for="contraseña" class="label-css">Contraseña:</label>
                    <input id="CONTRASEÑA" name="CONTRASEÑA" class="input-css" type="password" minlength="8" value="<?php echo $usuario['CONTRASEÑA'];?>" required oninput="validatePass();"/>
                    
                    <label for="telCliente" class="label-css">Telefono de Contacto: </label>
                    <input id="TELEFONO" name="TELEFONO" class="input-css" type="tel" value="<?php echo $usuario['TELEFONO'];?>" minlength="9"  required oninput="validateTel();"/>
                    
                    <?php if (isset($usuario) and ($usuario["OID_CLI"] == $oid_cliente)) { ?>
                    <td id="imagenes">
                        <div class="imagenes">
                            <button id="grabar" name="grabar" class="nav-link" type="submit">
                                <p>Guardar modificación</p>
                            </button>
                            <button id="borrar" name="borrar" class="nav-link" type="submit">
                                <p>Eliminar cliente</p>
                            </button>
                    <?php } ?> 
                </form>
            </div>
    <main>

</body>
</html>