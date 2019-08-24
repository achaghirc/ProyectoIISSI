<?php 
    session_start();
    require_once("gestionBD.php");
    require_once("gestionUsuario.php");
    require_once("gestionarProductos.php");

    if(isset($_REQUEST["IDENTIFICADOR"])){
        $editar["IDENTIFICADOR"] = $_REQUEST["IDENTIFICADOR"];
        $editar["NOMBRE"] = $_REQUEST["NOMBRE"];
        $editar["DESCRIPCION"] = $_REQUEST["DESCRIPCION"];
        $editar["PRECIO"] = $_REQUEST["PRECIO"];

        $_SESION["editar"] = $editar;

        $admin = $_SESSION["admin"];
        unset($_SESSION["admin"]);
    
        
    $conexion = crearConexionBD();

    $excepcion = modificarProducto($conexion,$editar["IDENTIFICADOR"],$editar["NOMBRE"],$editar["DESCRIPCION"],$editar["PRECIO"]);
        var_dump($editar['IDENTIFICADOR']);
        var_dump($editar['NOMBRE']);
        var_dump($editar['DESCRIPCION']);
        var_dump($editar['PRECIO']);
        
    cerrarConexionBD($conexion);

    if($excepcion){
        $_SESSION["modificar"] = $excepcion;
        $_SESSION["destino"] = "shopping-page.php?var2=".$admin['IDENTIFICADOR'];
        Header("Location:shopping-page.php?var2=".$editar['IDENTIFICADOR']);
    }else{
        Header("Location:shopping-page?var1=".$_GET["IDENTIFICADOR"]);
    }
}   
    else{
        Header("Location:shopping-page?var2=admin@admin.com&var1=".$_REQUEST["NOMBRE"]);
    }

?>