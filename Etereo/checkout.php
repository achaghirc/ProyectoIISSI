<!-- En este página, se registra el ID del cliente en la sesión y se obtienen los respectivos datos del cliente de la tabla clientes. 
Una vez que el cliente decide realizar el pedido, llamamos al archivo accion_carrito.php con la solicitud realizarPedido -->
<?php
require_once('gestionBD.php');
require_once('funciones_carrito.php');
require_once('gestionUsuario.php');
$conexion=crearConexionBD();
$carro = new funciones_carrito;

// Redirige a la pagina de compra si el carrito está vacío
if($carro->total_items() <= 0){
    header("Location: shopping-page.php");
}

// Modifica el id del cliente en la sesión
if(isset($_SESSION['login'])){
    $email = $_SESSION['login'];
    $oid_cli = consultarOID_CLI($conexion,$email);
    $custrow = $oid_cli -> Fetch(PDO::FETCH_ASSOC);
    cerrarConexionBD($conexion);
}
$_SESSION['sessCustomerID'] = $custrow['OID_CLI'];

// Obtiene los detalles del cliente con el id
$query = $conexion->query("SELECT * FROM Clientes WHERE oid_cli = ".$_SESSION['sessCustomerID']);
$cliente = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Checkout</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/carrito.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"  media="only screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<header>
<?php
    if (isset($_SESSION["login"])) { ?>
          <!-- Cabecera -->
         <nav class="nav-cabecera">
           <div class="cabecera" data-animation="over-left" data-collapse="medium" data-doc-height="1" data-duration="400" data-easing="ease-out" data-easing2="ease-out" data-no-scroll="1">
              <!-- Elementos a la izquierda -->
                <div class="navmenu_btn">
                <img src="./images/etereo.jpg" width="55" height="55" class="d-inline-block" alt="">
                </div>
                <div class="left-items">
                  <div class="navmenu_btn">
                    <a class="navmenu_link">Etéreo</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="coverPage.php" style="color: black; text-decoration:none;">Home</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="shopping-page.php" style="color: black; text-decoration:none;">Shop</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="aboutUs.php" style="color: black; text-decoration:none;">About us</a>
                  </div>
                </div>
                <!-- Elementos a la derecha -->
                <div class="right-items-admin">
                  <div class="btn-carrito">
                    <a id="right" class="nav-link" href="shopping-page.php" style="color: black; text-decoration:none;"> 
                      <img class="d-inline-block" src="./images/carro.png" width="30" height="30">
                    </a>
                  </div>
                  <?php $email = $_SESSION['login']; ?>
                  <div class="logueado">
                    <div class="iconUser"><img src="images/iconUser2.png" alt='Imagen Usuario' id="iconUser"/></div>
                    <div class="usuario"><a href="logout.php">
                    <b class="userName"> <?php echo $email?></b>
                    </a></div>
                  </div>
                </div>
                <?php }else {?>
            <nav class="nav-cabecera">
           <div class="cabecera" data-animation="over-left" data-collapse="medium" data-doc-height="1" data-duration="400" data-easing="ease-out" data-easing2="ease-out" data-no-scroll="1">
              <!-- Elementos a la izquierda -->
                <div class="navmenu_btn">
                <img src="./images/etereo.jpg" width="55" height="55" class="d-inline-block" alt="">
                </div>
                <div class="left-items">
                  <div class="navmenu_btn">
                    <a class="navmenu_link">Etéreo</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="coverPage.php" style="color: black; text-decoration:none;">Home</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="shopping-page.php" style="color: black; text-decoration:none;">Shop</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="aboutUs.php" style="color: black; text-decoration:none;">About us</a>
                  </div>
                </div>
                <!-- Elementos a la derecha -->
                <div class="right-items">
                  <div class="btn">
                    <a id="right" class="nav-link" href="shopping-page.php" style="color: black; text-decoration:none;"> 
                      <img class="d-inline-block" src="./images/carro.png" width="30" height="30">
                    </a>
                  </div>
                  <div class="btn">
                    <a class="login" href="form_alta_usuario.php">Login</a>
                  </div>
              </div>
          <?php  
          } 
          ?>
              </div> 
          </nav>
</header>

<div class="container">
    <div class="titulo">
        <h1>Carrito</h1>
    </div>
    <div class="contenido">
        <div class="tabla">
            <table class="carrito">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($carro->total_items() > 0){
                    //Obtiene los productos del carrito de la sesión
                    $filas = $carro->contents();
                    foreach($filas as $fila){
                    ?>
                        <tr>
                            <td><?php echo $fila["NOMBRE"]; ?></td>
                            <td><?php echo $fila["PRECIO"].' €'; ?></td>
                            <td><?php echo $fila["qty"]; ?></td>
                            <td><?php echo $fila["subtotal"].' €'; ?></td>
                        </tr>
                    <?php }
                }else{ ?>
                    <tr><td colspan="5"><p>No hay productos en tu carrito......</p></td>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <?php if($carro->total_items() > 0){ ?>
                            <td><strong>Total <?php echo $carro->total().' €'; ?></strong></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="cliente">
            <h4>Detalles del cliente</h4>
            <p><?php echo $cliente['NOMBRE']; ?></p>
            <p><?php echo $cliente['CORREOELECTRONICO']; ?></p>
            <p><?php echo $cliente['TELEFONO']; ?></p>
            <p><?php echo $cliente['DIRECCION']; ?></p>
        </div>
    </div>
    <div class="botones">
        <div class="boton continuar">
            <a href="shopping-page.php?var2=admin@admin.com" class="boton">Continuar comprando</a>
        </div>
        <div class="boton checkout">
            <a href="accion_carrito.php?action=realizarPedido" class="boton">Realizar pedido</a>
        </div>
    </div>
</div>
</body>
</html>