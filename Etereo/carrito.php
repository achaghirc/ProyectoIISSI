<!-- Esta página obtiene el contenido del carrito y muestra sus artículos con el precio total. 
Además, el usuario podrá agregar más elementos al carrito mediante el botón Continuar comprando o finalizarlo mediante el botón Checkout. 
Este último botón redirige al usuario a la página checkout.php donde el usuario tendrá una vista previa del pedido. -->
<?php
require_once('funciones_carrito.php');
$carro = new funciones_carrito;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Carrito</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/carrito.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"  media="only screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    function actualizaCarrito(obj,id){
        $.get("accion_carrito.php", {action:"actualizaCarrito", id:id, qty:obj.value}, function(data){
            if(data !== null){
                location.reload();
            }else{
                alert('Actualización de carrito fallida, por favor vuelve a intentarlo.');
            }
        });
    }
    </script>
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
                    <a class="navmenu_link" href="index.php" style="color: black; text-decoration:none;">Home</a>
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
                    <a class="navmenu_link" href="index.php" style="color: black; text-decoration:none;">Home</a>
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
        <div class="tabla" style="width: 100%;">
            <table class="carrito">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($carro->total_items() > 0){
                //Obtiene los productos del carrito 
                $filas = $carro->contents();
                    foreach($filas as $fila){
                    ?>
                    <tr>
                        <td><?php echo $fila["NOMBRE"]; ?></td>
                        <td><?php echo $fila["PRECIO"].' €'; ?></td>
                        <td><input type="number" class="boton cantidad" value="<?php echo $fila["qty"]; ?>" onchange="actualizaCarrito(this, '<?php echo $fila['rowid'];?>')"></td>
                        <td><?php echo $fila["subtotal"].' €'; ?></td>
                        <td>
                            <a href="accion_carrito.php?action=eliminaCarrito&id=<?php echo $fila["rowid"]; ?>" class=" boton eliminar" onclick="return confirm('¿Estás seguro de eliminar el producto del carrito?')"><img src="./images/borraUsuario.png" style="width:8%;    vertical-align: text-bottom;"/></a>
                        </td>
                    </tr>
                    <?php }
                }else{ ?>
                    <tr><td colspan="5" style="text-align: center;"><p>Tu carrito está vacío...</p></td>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <?php if($carro->total_items() > 0){ ?>
                            <td><strong>Total: <?php echo $carro->total().' €'?></strong></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="botones">
        <div class="boton continuar">
            <a href="shopping-page.php" class="boton">Continuar comprando</a>
        </div>
        <div class="boton checkout">
            <a href="checkout.php" class="boton">Checkout</a>
        </div>
    </div> 
</div>
</body>
</html>