<!--Todos los productos se obtendrán de la tabla productos y se mostrarán con el botón Añadir al carrito. 
Dicho botón redirecciona al usuario a la página accion_carrito.php con la solicitud aniadirCarrito 
y el respectivo ID del producto. -->
<?php
// Implementacion de la base de datos
require_once("gestionBD.php");
require_once("gestionarProductos.php");
$conexion=crearConexionBD();
$filas = consultarTodosProductos($conexion);
cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Página de compras</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/shopping.css" media="screen"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<?php include_once("cabecera.php"); ?>
<div class="container">
    <div class="titulo">
        <h1>Productos</h1>
    </div>
    <div id="productos" class="fila">
        <?php if(true){ 
            foreach($filas as $fila) {  ?>
                <?php if($fila["NOMBRE"]=='Merchandising'){ ?>
                    <div class="columna merch">
                <?php }else if($fila["NOMBRE"]=='Fotografía'){?>
                    <div class="columna fotog">
                <?php }else{   ?>
                    <div class="columna">
                <?php } ?>
                        <img class="imagen" src="./images/temperas.jpeg">
                        <div class="datos">
                            <h2><?php echo $fila["NOMBRE"]; ?></h2>
                            <h3><?php echo $fila["DESCRIPCION"]; ?></h3>
                            <p><?php echo $fila["PRECIO"].' €'; ?></p>
                            <button class="aniadir" role="link" onclick="window.location='accion_carrito.php?action=aniadirCarrito&id=<?php echo $fila['IDENTIFICADOR']?>'">
                            Añadir al carrito
                            </button>
                        </div>
                    </div>
            <?php }
        }else{ ?>
            <p>Productos no encontrados.....</p>
        <?php } ?>
    </div>
</div>
</body>
</html>