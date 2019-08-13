<?php
  
       
     //   session_start();

       
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" type="text/css" href="css/form_alta_usuario.css"/>
    <link rel="stylesheet" type="text/css" href="css/excepciones.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/validacion.js" type="text/javascript"></script>
</head>
<body>
    <header>
    <?php
       include_once("cabecera.php");
    ?>
    <?php
     //Si no existen datos del formulario en la sesion, se crea una 
        //entrada con los valores por defecto
        if(!isset($_SESSION['formulario'])){
            $formulario['cif'] = "";
            $formulario['nombre'] = "";
            $formulario['direccion'] = "";
            $formulario['correoElectronico']="";
            $formulario['contraseña'] = "";
            $formulario['telCliente'] = "";

            $_SESSION['formulario'] = $formulario;
        }
        /*Si ya existian valores los cogemos para inicializar el formulario */
        else {
                $formulario = $_SESSION['formulario'];
        }
        /*Si hay errores de validacion, hay que mostrarlos y marcar los campos */
        if(isset($_SESSION["errores"]))
            $errores = $_SESSION["errores"];
    ?>
    </header>
    <script>
		// Inicialización de elementos y eventos cuando el documento se carga completamente
		$(document).ready(function() {
			$("#altaUsuario").on("submit", function() {
				return validateForm();
            });

				validaCif();            

				validaNombre();
            
				validaDireccion();

				validaEmail();

			//Manejador de evento del color de la contraseña
			$("#contraseña").on("keyup", function() {
				colorContraseña();
            });

            $("#confirmpassword").on("keyup", function() {
				validarConfirmacion();
            });  

				validaTelefono();

        });
    </script>
        <div id="formularios">
            <div id="formAlta">
                <form id="altaUsuario" method="get" action="validacion_alta_usuario.php"  class="formulario" >
                        <div class="informacion">
                            <p>
                                <i>Todos los campos son obligatorios</i>
                            </p> 
                        </div>
                 <h1 class="titulo_formulario">Registrate</h1>
                    
                    <label for="cif" class="label-css">CIF: </label>
                    <input id="cif" name="cif" class="input-css" type="text" size="40" placeholder="B01234567" required oninput="validaCif();"/>
                     
                    <label for="nom" class="label-css">Nombre Empresa:</label>
                    <input id="nombre" name="nombre" class="input-css" type="text" placeholder="Nombre de la Empresa" required oninput="validaNombre();"/>
                    
                    <label for="direc" class="label-css">Direccion:</label>
                    <input id="direccion" name="direccion" class="input-css" type="text" placeholder="C/XXXXX NºX.." required oninput="validaDireccion();"/>
                    
                    <label for="correoElec" class="label-css">Correo Electronico: </label>
                    <input id="correoElectronico" name="correoElectronico"class="input-css" type="text" size="40" placeholder="example@dominio.extension" required oninput="validaEmail();"/>
                    
                    <div><label for="contraseña" class="label-css">Contraseña:<em>*</em></label>
                    <input type="password" id="contraseña" name="contraseña" class="input-css" placeholder="Mínimo 8 caracteres entre letras y dígitos" required oninput="validarContraseña();" />
                    </div>

                    <div><label for="confirmpassword" class="label-css">Confirmar Contraseña:</label>
                    <input id="confirmpassword" name="confirmpassword" class="input-css" type="password" placeholder="Repita contraseña" required oninput="validarConfirmacion();"/>
                    </div>

                    <label for="telCliente" class="label-css">Telefono de Contacto: </label>
                    <input id="telCliente" name="telCliente" class="input-css" type="tel" minlength="9" required oninput="validaTelefono();"/>
                    
                    <input type="submit"  class="boton-css"  value="Registrar"/>
   
                </form>
            </div>
    <div id="formLogin">
        <main>   
            <?php /*if (isset($error)) {
                /* echo "<div class=\"error\">";
                /* echo "Error en la contraseña o no existe el usuario.";
                /* echo "</div>";
                }*/	
            ?>
        
            <!-- The HTML login form -->
            <form action="login.php" method="post" class="login-inicio">
            <h1 class="titulo_inicio">Inicia Sesion</h1>
                <label for="email" class="label-css-inicio-Uno">Email: </label>
                <input type="text" name="email" class="input-css-inicio" id="email" />
                <label for="pass" class="label-css-inicio">Contraseña: </label>
                <input type="password" name="pass" class="input-css-inicio" id="pass" />
                
                <input type="submit" name="submit" value="Iniciar" class="boton-css-inicio"/>
                
                <p>¿No estás registrado? <a href="form_alta_usuario.php">¡Registrate!</a></p>
            </form>
        </main>
    </div>
</div>

</body>
</html>