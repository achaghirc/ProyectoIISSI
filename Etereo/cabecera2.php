<head>
<link rel="stylesheet" type="text/css" href="css/style.css"  media="only screen" />
</head>
<body>
          <?php 
        //  session_start();
          $admin = 'admin@admin.com';
          if (isset($_SESSION["login"])) { ?>
          <!-- Cabecera -->
          <?php $email = $_SESSION['login']; ?>
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
                  
                  <div class="logueado">
                    <div class="iconUser"><img src="images/iconUser2.png" alt='Imagen Usuario' id="iconUser"/></div>
                    <div class="usuario"><a href="logout.php">
                    <b class="userName"> <?php echo $email?></b>
                    <a href="DarBaja.php" class=" boton eliminar" onclick="return confirm('¿Estás seguro de eliminar tu usuario de la pagina?')">Darse de baja<img src="./images/borraUsuario.png" style="width:8%;    vertical-align: text-bottom;"/></a>
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
</body>