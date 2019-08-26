<?php
        session_start();
        require_once("gestionBD.php");
        require_once("gestionUsuario.php");
        //Si no existen datos del formulario en la sesion, se crea una 
        //entrada con los valores por defecto
        if(isset($_SESSION['usuario'])){
            $usuario=$_SESSION['usuario'];
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
    <link rel="stylesheet" type="text/css" href="css/prueba.css"/>
        <?php 
            $cif = $_REQUEST['var2'];
            echo $cif."\n";
            echo $usuario["CORREOELECTRONICO"];
            $conexion = crearConexionBD();
            $query = $conexion->query("SELECT * FROM CLIENTE"
            . " WHERE (CLIENTE.CIF = '".$cif."')");
            $custrow = $query->fetch(PDO::FETCH_ASSOC);
        ?>
</head>
<body>
        <form id="actualizaUsuario" method="post" action="accion_actualizar_usuario.php"  class="formulario" novalidate>
                        <div class="informacion">
                            <p>
                                <i>Elige los campos a editar para el usuario</i>
                            </p> 
                        </div>
                 <h1 class="titulo_formulario">Actualiza</h1>
                    
                    <label for="cif" class="label-css">CIF: </label>
                    <input id="cif" name="cif" class="input-css" type="string" size="40" value="<?php echo $usuario['CIF'];?>"  required/>
                     
                    <label for="nom" class="label-css">Nombre Empresa:</label>
                    <input id="nombre" name="nombre" class="input-css" type="text" value="<?php echo $usuario['NOMBRE']?>" required>
                    
                    <label for="direc" class="label-css">Direccion:</label>
                    <input id="direccion" name="direccion" class="input-css" type="text" value="<?php echo $usuario['DIRECCION'];?>"  required/>
                    
                    <label for="correoElec" class="label-css">Correo Electronico: </label>
                    <input id="correoElectronico" name="correoElectronico"class="input-css" type="text" size="40" value="<?php echo $custrow['CORREOELECTRONICO'];?>" required>
                    
                    <label for="contraseña" class="label-css">Contraseña:</label>
                    <input id="contraseña" name="contraseña" class="input-css" type="password" minlength="8" placeholder="<?php echo $usuario['CONTRASEÑA'];?>" required/>
                    
                    <label for="confirmpassword" class="label-css">Confirmar Contraseña:</label>
                    <input id="confirmpassword" name="confirmpassword" class="input-css" type="password" minlength="8" placeholder="<?php echo $usuario['CONTRASEÑA'];?>" required/>
                    
                    <label for="telCliente" class="label-css">Telefono de Contacto: </label>
                    <input id="telCliente" name="telCliente" class="input-css" type="tel" vaule="<?php echo $usuario['TELEFONO'];?>" minlength="9"  required/>
                    
                    <?php if (isset($usuario) and ($usuario["CIF"] == $cif)) { ?>
                    <td id="imagenes">
                        <div class="imagenes">
                            <button id="grabar" name="grabar" class="nav-link" type="submit">
										<p>Guardar modificación</p>
                                    </button>
                    <?php } else { ?>
                            <button id="editar" name="editar" class="nav-link" type="submit">
										<p>Editar Cliente</p>
							</button>
                    <?php } ?>
                    
                </form>
    <main>

</body>
</html>