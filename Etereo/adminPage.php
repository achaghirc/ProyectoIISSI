<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/php; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Etéreo</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="assets/favicon.ico">
            <!-- Importo hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="css/vistaAdministrador.css"  media="only screen" />
</head>
<body style="margin: unset;">
        <?php
            include_once("gestionUsuario.php");
            include_once("gestionBD.php");
            session_start();
            $conexion = crearConexionBD();
            $email = $_SESSION['login'];
            $pass = $_SESSION['pass'];
            $esAdmin = consultarSiAdministrador($conexion,$email,$pass);
            $custrow= $esAdmin -> Fetch(PDO::FETCH_ASSOC);
            cerrarConexionBD($conexion);

            if($custrow['ADMINISTRADOR'] == "YES"){
                include_once("cabeceraAdmin.php");
            }
        ?>
        <?php
           // include_once("cabecera.php");
            if(isset($_SESSION['login'])){
                $admin = $_SESSION['login'];
            }
            if(isset($_SESSION['usuario'])){
                $usuario = $_SESSION['usuario'];
                unset($_SESSION['usuario']);
              
            }
                require_once("gestionBD.php");
                require_once("gestionUsuario.php");
                $conexion=crearConexionBD();
                $filas = consultarUsuarios($conexion);
           
                cerrarConexionBD($conexion);
        ?>
    <section class="cuerpo">
        <div id="cuerpo">
            <table class="tablaUsuarios">
                <tr class="titulos">
                    <th id="columOID">OID_CLIENTE</th>
                    <th id="nombre">NOMBRE</th>
                    <th id="cif">CIF</th>
                    <th id="direccion">DIRECCIÓN</th>
                    <th id="correoElectronico">CORREO ELECTRONICO</th>
                    <th id="contraseña">CONTRASEÑA</th>
                    <th id="telefono">TELEFONO</th>
                    <th></th>
                </tr>
                
                <?php
                
                foreach($filas as $fila) {
                  
                     ?>
                <form method='post' action="controlador_usuario.php">
                    <div>
                        <div>
                    <input id= "OID_CLI" name ="OID_CLI" type="hidden" value="<?php echo $fila["OID_CLI"]; ?>"/>
                    <input id= "NOMBRE" name ="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
                    <input id= "CIF" name ="CIF" type="hidden" value="<?php echo $fila["CIF"]; ?>"/>
                    <input id= "DIRECCION" name ="DIRECCION" type="hidden" value="<?php echo $fila["DIRECCION"]; ?>"/>
                    <input id= "CORREOELECTRONICO" name ="OID_CLI" type="hidden" value="<?php echo $fila["CORREOELECTRONICO"]; ?>"/>
                    <input id= "CONTRASEÑA" name ="CONTRASEÑA" type="hidden" value="<?php echo $fila["CONTRASEÑA"]; ?>"/>
                    <input id= "TELEFONO" name ="TELEFONO" type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>
                    
                    <?php if(isset($usuario) and ($_GET["var2"] == $fila["CIF"])){?>
                    <!--Editando Cliente-->
                    <td><h4><?php echo $fila["OID_CLI"];?></h4></td>
                    <td><h3><input id="NOMBRE" name="NOMBRE" type="text" value="<?php echo $fila["NOMBRE"];?>"/></h3></td>
                    <td><h3><input id="CIF" name="CIF" type="text" value="<?php echo $fila["CIF"];?>"/></h3></td>
                    <td><h3><input id="DIRECCION" name="DIRECCION" type="text" value="<?php echo $fila["DIRECCION"];?>"/></h3></td>
                    <td><h3><input id="CORREOELECTRONICO" name="CORREOELECTRONICO" type="text" value="<?php echo $fila["CORREOELECTRONICO"];?>"/></h3></td>
                    <td><h3><input id="CONTRASEÑA" name="CONTRASEÑA" type="password" value="<?php echo $fila["CONTRASEÑA"];?>"/></h3></td>
                    <td><h3><input id="TELEFONO" name="TELEFONO" type="text" value="<?php echo $fila["TELEFONO"];?>"/></h3></td>
                    <?php } else { ?>
                    <!--Mostrando cliente-->
                    <input id=CIF name="CIF" type="hidden" value="<?php echo $fila["CIF"];?>"/>
                    <td class="datos"><h4><?php echo $fila["OID_CLI"];?></h4></td>
                    <td class="datos"><h4><?php echo $fila["NOMBRE"];?></h4></td>
                    <td class="datos"><h4><?php echo $fila["CIF"];?></h4></td>
                    <td class="datos"><h4><?php echo $fila["DIRECCION"];?></h4></td>
                    <td class="datos"><h4><?php echo $fila["CORREOELECTRONICO"];?></h4></td>
                    <td class="datos"><h4><?php echo $fila["CONTRASEÑA"];?></h4></td>
                    <td class="datos"><h4><?php echo $fila["TELEFONO"];?></h4></td>
                    <?php } ?>
                    <td id="imagenes">
                    <?php if ($_GET['var2']==$admin) { ?>
                        <div class="imagenes">
                        <button id="editar" name="editar" class="nav-link" type="submit">
										<p>Editar Cliente</p>
							</button>
                    <?php } else if(isset($usuario) and ($usuario["CIF"] == $fila["CIF"])){ ?>
                        <button id="grabar" name="grabar" class="nav-link" type="submit">
										<p>Guardar</p>
                                    </button>    
                     
							<button id="borrar" name="borrar" class="nav-link" type="submit">
										<p>Borrar Cliente</p>
                            </button>
                    <?php } ?>
                                       
                        </div>
                    </td>
                </tr>
                    </form>
                <?php 
                    } ?>
            </table>
        </div>
    </section>
   
</body>
</html>