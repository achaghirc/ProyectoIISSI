<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/php; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Etéreo</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="assets/favicon.ico">
            <!-- Importo hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="css/coverPage.css"  media="only screen" />
</head>
    <body style="margin: unset;">
    <?php
            include_once("cabecera.php");
        ?>
      <!--Foto principal-->
      <header class="header">
      <section class="section-principal">
      <div class="contenedor-principal">
        <div class="principal">
          <img id="imagen-principal" alt="" data-type="image"
          itemprop="image" src="./images/portada2.jpg"></div>
        <div class="text-slogan">
          <h2 class="font_1">Descubre la publicidad</h2>
          <h2 class="font_1">que llevas dentro</h2>
        </div>  
      </div>
      </section>
      <!--Fotos de productos-->
      <section class="strc1" style="left:0;width:100%;max-width:100%;height:auto;margin-left:0;">
        <div class="productos">
          <div class="ejemplos-derecha">
            <div><img id="producto" alt="" data-type="image" itemprop="image" src="./images/socialMediaMarketing.jpg"></div>
          </div>
          <div class="ejemlos-izquierda">
            <div><img id="producto" alt="" data-type="image" itemprop="image" src="./images/prodFotografica.jpg"></div>
            <div><img id="producto" alt="" data-type="image" itemprop="image" src="./images/diseñoWeb.jpg"></div>
          </div>
          <div class="mas-productos">
            <div><a id="enlace" href="shopping-page.php">Más productos..</a></div>
          </div>
        </div>
      </section>
      </header>
    </body>
</html>