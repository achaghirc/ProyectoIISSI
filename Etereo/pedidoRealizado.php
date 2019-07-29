<?php
if(!isset($_REQUEST['id'])){
    header("Location: shopping-page.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pedido Realizado</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/carrito.css" media="screen"/>
</head>
</head>
<body style="font-family: sans-serif;">
<?php include_once ("cabecera.php"); ?>
<div class="container">
    <h1>Estado del pedido:</h1>
    <p style="color: #34a853;font-size: 18px;">Tu pedido se ha realizado correctamente. El ID de compra es: #<?php echo $_GET['id']; ?></p>
</div>
</body>
</html>