<?php
        session_start();
        
        //Importar las librerias para gestionar la BD
        require_once("gestionBD.php");
        require_once("cabecera.php");

        /*Comprobar que hemos llegado a esta pagina porque se ha rellenado el formulario */
        if(isset($_SESSION["formulario"])) {
            $nuevoUsuario["cif"] = $_REQUEST["cif"];
            $nuevoUsuario["nombre"] = $_REQUEST["nombre"];
            $nuevoUsuario["direccion"] = $_REQUEST["direccion"];
            $nuevoUsuario["correoElectronico"] = $_REQUEST["correoElectronico"];
            $nuevoUsuario["contraseña"] = $_REQUEST["contraseña"];
            $nuevoUsuario["confirmpassword"] = $_REQUEST["confirmpassword"];
            $nuevoUsuario["telCliente"] = $_REQUEST["telCliente"];

        }else {
            Header("Location: form_alta_usuario.php");
        }
        /*Guardar la varible local con los datos del formulario en la sesion */
        $_SESSION["formulario"] = $nuevoUsuario;

        /*Validamos el formulario en el servidor */
        /*Si se produce alguna excepcion PDO en la validacion, volvemos al formulario informando al usuario */
        try{
            $conexion = crearConexionBD();
            $errores = validarDatosUsuario($conexion,$nuevoUsuario);
            cerrarConexionBD($conexion);
        }catch(PDOException $e){
            /*Mensaje de depuracion */
            $_SESSION["errores"] = "<p>ERROR en la validacion: fallo en el acceso a la base de datos.</p><p>"
                .$e -> getMessage() ."</p>";
                Header('Location: form_alta_usuario.php');
        }

        if(count($errores)>0){
            //Guardo en la sesion los mensajes de error y volvemos al formulario
            $_SESSION["errores"] = $errores;
            Header('Location:form_alta_usuario.php');
        }else {
            //Si todo va bien, vamos a la pagina de exito
            Header('Location:accion_alta_usuario.php');
        }

    function validarDatosUsuario($conexion,$nuevoUsuario){
    $errores = array();
    //Validar el Cif
    if($nuevoUsuario["cif"] == ""){
        $errores[] = "<p>El cif no puede estar vacío</p>";
    }
    //Validar el nombre
    if($nuevoUsuario["nombre"] == ""){
        $errores[] = "<p>El nombre no puede estar vacío</p>";
    }
    //Validar la direccion
    if($nuevoUsuario["direccion"] == ""){
        $errores[] = "<p>La direccion no puede estar vacía</p>";
    }
    //Validar correoElectronico
    if($nuevoUsuario["correoElectronico"] == ""){
        $errores[] = "<p>El correo electronico no puede estar vacío</p>";
    }else if(!filter_var($nuevoUsuario["correoElectronico"],FILTER_VALIDATE_EMAIL)){
        $errores[] ="<p>El email es incorrecto: ".$nuevoUsuario["correoElectronico"]."</p>";
    }
    //Validar la contraseña 
    if(!isset($nuevoUsuario["contraseña"]) ||strlen($nuevoUsuario["contraseña"])<8){
        $errores[] = "<p>La contraseña no es valida: debe tener al menos 8 caracteres</p>";
    }else if($nuevoUsuario["contraseña"] != $nuevoUsuario["confirmpassword"]){
        $errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
    }
    //Validar telCliente
    if($nuevoUsuario["telCliente"] == ""){
        $errores[] = "<p>El telefono no puede estar vacío</p>";
    }else if(strlen($nuevoUsuario["telCliente"])>9){
        $errores[] = "<p> El telefono no puede superar 9 caracteres </p>";
    }
    return $errores;
}
?>