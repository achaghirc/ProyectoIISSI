<?php
    session_start();

    if(isset($_REQUEST["NOMBRE"])){
        $admin["NOMBRE"] = $_REQUEST["NOMBRE"];
        $admin["DESCRIPCION"] = $_REQUEST["DESCRIPCION"];
        $admin["PRECIO"] = $_REQUEST["PRECIO"];

        $_SESSION["admin"] = $admin;

        if(isset($_REQUEST["editar"])) Header("Location:shopping-page.php?var2=".$_REQUEST["NOMBRE"]);
        else if(isset($_REQUEST["grabar"])) Header("Location: accion_actualizar_productos.php?var2=".$_REQUEST["NOMBRE"]);
           
    }else {
        Header("Location: error.php?var2=".$_REQUEST["NOMBRE"]);
    }

?>