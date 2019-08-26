<!DOCTYPE html>
<html>
<head>
    <title>Página de administrador</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/vistaAdministrador.css" media="screen"/>
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
    <?php //  session_start(); ?>
    <?php 
    if(isset($_SESSION['login'])){
        $admin = $_SESSION['login'];
    }
    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
        unset($_SESSION['usuario']);        
    }
    require_once("gestionBD.php");
    require_once("gestionUsuario.php");
    require_once("paginacion_consulta.php");
    if (isset($_SESSION["paginacion"]))
        $paginacion = $_SESSION["paginacion"];
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 3);
    if ($pagina_seleccionada < 1)
        $pagina_seleccionada = 1;
    if ($pag_tam < 1)
        $pag_tam = 3;
	unset($_SESSION["paginacion"]);
    $conexion=crearConexionBD();
    $query = 'SELECT * FROM CLIENTES';
    $total_registros = total_consulta($conexion, $query);
    $total_paginas = (int)($total_registros / $pag_tam);
    if ($total_registros % $pag_tam > 0)
        $total_paginas++;
    if ($pagina_seleccionada > $total_paginas)
        $pagina_seleccionada = $total_paginas;
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
    $paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
    $filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
    cerrarConexionBD($conexion);
    ?>
    <nav>	
        <div class="enlaces">
            <?php for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) { ?>
                <div class="numero">
		    	    <?php if ( $pagina == $pagina_seleccionada) { 	?>
			       	    <span class="current"><?php echo $pagina; ?></span>
    		        <?php }	else { ?>
        				<a href="adminPage.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>&var2=admin@admin.com"><?php echo $pagina ?></a>
	                <?php } ?>
                </div>
            <?php } ?>
	        <form method="get" action="adminPage.php" class="mostrando">
                
        		<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
        		Mostrando
		        <input id="PAG_TAM" class="nelementos" name="PAG_TAM" type="number" min="1" max="<?php echo $total_registros ?>"
            		value="<?php echo $pag_tam?>" autofocus="autofocus" />
                clientes de <?php echo $total_registros?>
                <input id="var2" name="var2" type="hidden" value="<?php echo $_SESSION['login'] ?>"/>
    	    	<input type="submit" value="Cambiar" class="botones">
            </form>
        </div>
    </nav>
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
                <?php foreach($filas as $fila) { ?>
                <article>
                    <form method="post" action="controlador_usuario.php">
                        <div>
                    <input id= "OID_CLI" name ="OID_CLI" type="hidden" value="<?php echo $fila["OID_CLI"]; ?>"/>
                    <input id= "NOMBRE" name ="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
                    <input id= "CIF" name ="CIF" type="hidden" value="<?php echo $fila["CIF"]; ?>"/>
                    <input id= "DIRECCION" name ="DIRECCION" type="hidden" value="<?php echo $fila["DIRECCION"]; ?>"/>
                    <input id= "CORREOELECTRONICO" name ="OID_CLI" type="hidden" value="<?php echo $fila["CORREOELECTRONICO"]; ?>"/>
                    <input id= "CONTRASEÑA" name ="CONTRASEÑA" type="hidden" value="<?php echo $fila["CONTRASEÑA"]; ?>"/>
                    <input id= "TELEFONO" name ="TELEFONO" type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>
                    
                    <?php if(isset($usuario) and ($_GET["var2"] == $fila["OID_CLI"])){?>
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
                    <input id="OID_CLI" name="OID_CLI" type="hidden" value="<?php echo $fila["OID_CLI"];?>"/>
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
                    <?php } else if(isset($usuario) and ($usuario["OID_CLI"] == $fila["OID_CLI"])){ ?>
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
                </article>
                <?php } ?>
            </table>
        </div>
    </section>
</body>
</html>