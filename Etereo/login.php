<?php 
        session_start();

        include_once("gestionBD.php");
        include_once("gestionUsuario.php");

        if(isset($_POST['submit'])){
            $correoElectronico = $_POST['email'];
            $contraseña = $_POST['pass'];
         

            $conexion = crearConexionBD();
            $num_usuarios = consultaUsuario($conexion,$correoElectronico,$contraseña);
            $Admin = consultarSiAdministrador($conexion,$correoElectronico,$contraseña);
            $custrow = $Admin -> Fetch(PDO::FETCH_ASSOC);
            "\n"."\n"."\n"."\n"."\n".var_dump($custrow);
            "\n"."\n"."\n"."\n"."\n".var_dump($num_usuarios);
            cerrarConexionBD($conexion);

            if($num_usuarios == 0){
                $error = "error";
                Header('Location:error.php');
            }else if($custrow["ADMINISTRADOR"] == 'YES' ){
                    Header("Location:adminPage.php?var2=".$correoElectronico);
                    $_SESSION['login'] = $correoElectronico;
                    $_SESSION['pass'] = $contraseña;

            }else if($custrow["ADMINISTRADOR"] == 'NO'){
                    Header("Location:index.php?var2=".$correoElectronico); 
                    $_SESSION['login'] = $correoElectronico;  
                    $_SESSION['pass'] = $contraseña;
                }
             
            }
        
        
        
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/css/login.css" />
<title>Etereo: Login</title>
</head>
     
<body>
        
        <?php
            include_once("cabecera.php");
        ?>
    <div class="salta" style="margin-top:100px">
        <fieldset class="salta">
          
            <main>
                <?php if (isset($error)) {
                echo "<h1 class=\"errores\">";
                echo "Error en la contraseña o no existe el usuario.";
                echo "</h1>";
                }	
                ?>
            
                <h1 class="mensage-error">¿No estás registrado? <a href="form_alta_usuario.php">¡Registrate!</a></h1>
            
            </main>
          
        </fieldset>
    </div>
        <?php
           // include_once("pie.php");
        ?>
</body>
</html>