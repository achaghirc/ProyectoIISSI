<?php
    session_start();
    //Se comprueba que se ha recibido el parametro identificador de uno de los prodcutos
    //para evitar que se acceda directamente
    if(isset($_REQUEST["IDENTIFICADOR"])){
        $admin["IDENTIFICADOR"] = $_REQUEST["IDENTIFICADOR"];
        $admin["NOMBRE"] = $_REQUEST["NOMBRE"];
        $admin["DESCRIPCION"] = $_REQUEST["DESCRIPCION"];
        $admin["PRECIO"] = $_REQUEST["PRECIO"];

        $_SESSION["admin"] = $admin;


           
    }else {
        Header("Location: error.php?var2=".$_REQUEST["IDENTIFICADOR"]);
    }   
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>Modificar Producto</title>
    <link rel="stylesheet" type="text/css" href="css/modificar_producto.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/validacion.js" type="text/javascript"></script>
</head>
<body>
    <header>
    <?php
      include_once("gestionUsuario.php");
      include_once("gestionBD.php");
      
      $conexion=crearConexionBD();
      $email = $_SESSION['login'];
      $pass = $_SESSION['pass'];
      $esAdmin = consultarSiAdministrador($conexion,$email,$pass);
      $custrow= $esAdmin -> Fetch(PDO::FETCH_ASSOC);
      cerrarConexionBD($conexion);

          if($custrow['ADMINISTRADOR'] == "YES"){
              include_once("cabeceraAdmin.php");
          }else if($custrow['ADMINISTRADOR'] == "NO"){
              include_once("cabecera2.php");
          }else{
              include_once("cabecera.php");
          }
    ?>
    <?php
     
        
    ?>
    </header>
    
    <?php 
        // Mostrar los erroes de validación (Si los hay)
        if(isset($errores) && count($errores) > 0){
            echo "<div id=\"div_errores\" class=\"error\">";
                echo "<h4>Errores en el formulario:</h4>";
                foreach($errores as $error) echo $error;
                echo "</div>";
        }
                      
    ?>
        <div id="formularios">
            <div id="formAlta">
                <form id="modificarProd" method="get" action="accion_actualizar_productos.php"  class="formulario" >
                        <div class="informacion">
                            <p>
                                <i>Todos los campos son obligatorios</i>
                            </p> 
                        </div>
                 <h1 class="titulo_formulario">Edite los campos</h1>
                    
                    <label for="IDENTIFICADOR" class="label-css">IDENTIFICADOR: </label>
                    <input id="IDENTIFICADOR" name="IDENTIFICADOR" class="input-css" type="text" size="40" value="<?php echo $_REQUEST["IDENTIFICADOR"] ?>" readonly  />
                     
                    <label for="NOMBRE" class="label-css">NOMBRE:</label>
                    <input id="NOMBRE" name="NOMBRE" class="input-css" type="text" placeholder="<?php echo $_REQUEST["NOMBRE"] ?>" required/>
                    
                    <label for="DESCRIPCION" class="label-css">DESCRIPCION:</label>
                    <textarea id="DESCRIPCION" name="DESCRIPCION" class="input-css" cols="40" rows="5" required ><?php echo $_REQUEST["DESCRIPCION"] ?></textarea>
                    
                    <label for="PRECIO" class="label-css">PRECIO: </label>
                    <input id="PRECIO" name="PRECIO" class="input-css" type="number" placeholder="<?php echo $_REQUEST["PRECIO"] ?>" required/>

                    <button class="aniadir" type="submit">
                                Guardar Producto
                    </button>
                </form>
</div>

</body>
</html>