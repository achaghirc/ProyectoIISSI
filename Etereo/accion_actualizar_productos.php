<?php 
    session_start();
    require_once("gestionBD.php");
    require_once("gestionUsuario.php");

    if(isset($_SESSION["admin"])){
        $admin = $_SESSION["admin"];
        unset($_SESSION["admin"]);
    

    $conexion = crearConexionBD();

    $modificar = modificarProducto($conexion,$admin["NOMBRE"],$admin["DESCRIPCION"], $admin["PRECIO"]);

    cerrarConexionBD($conexion);

    if($modificar){
        $_SESSION["modificar"] = $modificar;
        $_SESSION["destino"] = "shopping-page.php?var1=".$_GET["var1"];
        Header("Location: shopping-page.php?var1=".$_SESSION['admin']);
    }else{
        Header("Location:shopping-page?var1=".$_GET["var1"]);
    }
}   
    else{
        Header("Location:shopping-page?var2=admin@admin.com&var1=".$_REQUEST["NOMBRE"]);
    }
cerrarConexionBD($conexion);
?>