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
        require_once("gestionBD.php");
        require_once("gestionUsuario.php");
        $conexion=crearConexionBD();
        $filas = consultarUsuarios($conexion);
        cerrarConexionBD($conexion);
        ?>
        <?php
            include_once("cabecera.php");
        ?>
    <section class="cuerpo">
        <div id="cuerpo">
            <table class="tablaUsuarios">
                <tr class="titulos">
                    <th id="columOID">OID_CLIENTE</th>
                    <th id="nombre">NOMBRE</th>
                    <th id="cif">CIF</th>
                    <th id="direccion">DIRECCIÓN</th>
                    <th id="email">EMAIL</th>
                    <th id="telefono">TELEFONO</th>
                    <th></th>
                </tr>
                <?php
                 
                    foreach($filas as $fila) { ?>
                <tr style="text-align: center;">
                    <td><?php echo $fila["OID_CLI"]; ?></td>
                    <td><?php echo $fila["NOMBRE"]; ?></td>
                    <td><?php echo $fila["CIF"]; ?></td>
                    <td><?php echo $fila["DIRECCION"]; ?></td>
                    <td><?php echo $fila["CORREOELECTRONICO"]; ?></td>
                    <td><?php echo $fila["TELEFONO"]; ?></td>
                    <td id="imagenes">
                        <div class="imagenes">
                            
                            <a class="nav-link" title="Borrar" href="bascketPage.html"> 
                                <img class="imagen" src="./images/borraUsuario.png" alt="Borrar">
                            </a>
                            
                            
                            <a class="nav-link" title="Actualizar" href="form_actualizar_usuario.php"> 
                                <img class="imagen" src="./images/actualizaUsuario.png" alt="Actualizar">
                            </a>
                            
                        </div>
                    </td>
                </tr>
                    <?php 
                    } ?>
            </table>
        </div>
    </section>
</body>
</html>