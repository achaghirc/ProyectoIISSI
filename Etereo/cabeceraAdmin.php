<head>
<link rel="stylesheet" type="text/css" href="css/style.css"  media="only screen" />
</head>
<body>
          <?php 
          $admin = 'admin@admin.com';
         ?>
          <!-- Cabecera -->
          <?php $email = $_SESSION['login']; ?>
         <nav class="nav-cabecera">
           <div class="cabecera" data-animation="over-left" data-collapse="medium" data-doc-height="1" data-duration="400" data-easing="ease-out" data-easing2="ease-out" data-no-scroll="1">
              <!-- Elementos a la izquierda -->
                <div class="navmenu_btn">
                <img src="./images/etereo.jpg" width="55" height="55" class="d-inline-block" alt="">
                </div>
                <div class="left-items">
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="shopping-page.php?var2=admin@admin.com" style="color: black; text-decoration:none;">Shop</a>
                  </div>
                  <div class="navmenu_btn" data-ix="show-sub-menu">
                    <a class="navmenu_link" href="adminPage.php?var2=admin@admin.com" style="color: black; text-decoration:none;">Admin Page</a>
                  </div>
                </div>
                <!-- Elementos a la derecha -->
                <div class="right-items-admin">
                  <div class="btn-carrito">
                    <a id="right" class="nav-link" href="shopping-page.php" style="color: black; text-decoration:none;"> 
                      <img class="d-inline-block" src="./images/carro.png" width="30" height="30">
                    </a>
                  </div>
                  
                  <div class="logueado">
                    <div class="iconUser"><img src="images/iconUser2.png" alt='Imagen Usuario' id="iconUser"/></div>
                    <div class="usuario"><a href="logout.php">
                    <b class="userName"> <?php echo $email?></b>
                   <!-- <a href="DarBaja.php" class=" boton eliminar" onclick="return confirm('¿Estás seguro de eliminar tu usuario de la pagina?')">Darse de baja<img src="./images/borraUsuario.png" style="width:8%;    vertical-align: text-bottom;"/></a>-->
                    </a></div>
                  </div>
                </div>
              </div> 
          </nav>
</body>