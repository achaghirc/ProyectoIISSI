<!-- Este archivo gestiona toda acción solicitada por el usuario desde la página de la vista. Los distintos bloques de código se ejecutarán en función a la acción solicitada. Tenemos estas operaciones:

aniadirCarrito: Obtiene la información de un producto de su respectiva tabla mediante el ID e inserta el elemento en el carrito utilizando la clase funciones_carrito. Si todo ha salido bien, el usuario es redirigido a la página carrito.php.
actualizaCarrito: Actualiza el carrito mediante un rowid específico utilizando la clase funciones_carrito.
eliminaCarrito: Elimina un elemento específico del carrito mediante su ID a través de la clase Cart. Si todo ha salido bien, el usuario es redirigido a la página carrito.php.
realizarPedido: Inserta los artículos del carrito en las tablas pedidos y productospedido, y destruye los datos del carrito de la sesión. Si todo ha salido bien, el usuario es redirigido a la página pedidoRealizado.php. -->

<?php
// Inicializa la clase
require_once('funciones_carrito.php');
$carro = new funciones_carrito;

// Configuracion de la base de datos
require_once('gestionBD.php');
require_once('gestionarProductos.php');
$conexion = crearConexionBD();
if(isset($_SESSION['login'])){
    $email = $_SESSION['login'];
}
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'aniadirCarrito' && !empty($_REQUEST['id'])){
        $productoID = $_REQUEST['id'];
        // Obtiene los datos de los productos
        $query = $conexion->query("SELECT * FROM productos WHERE IDENTIFICADOR = $productoID");
      
        $producto = $query->fetch();
        $datos = array(
            'IDENTIFICADOR' => $producto['IDENTIFICADOR'],
            'NOMBRE' => $producto['NOMBRE'],
            'PRECIO' => $producto['PRECIO'],
            'qty' => 1
        );
        
        $insertar = $carro->insert($datos);
        $redirigir = $insertar?'carrito.php':'shopping-page.php';
        header("Location: ".$redirigir);
    }elseif($_REQUEST['action'] == 'actualizaCarrito' && !empty($_REQUEST['id'])){
        $datos = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $actualizar = $carro->update($datos);
        echo $actualizar?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'eliminaCarrito' && !empty($_REQUEST['id'])){
        $eliminar = $carro->remove($_REQUEST['id']);
        header("Location: carrito.php");
    }elseif($_REQUEST['action'] == 'realizarPedido' && $carro->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        //Insertamos el pedido en la base de datos solo 
        //para aquel cliente cuyo correo electronico sea igual al guardado en sesion.
        $sql="SELECT OID_CLI FROM CLIENTES"
        . " WHERE (CLIENTES.CORREOELECTRONICO = '".$email."')";
        $stmt=$conexion->prepare($sql);
        $stmt->execute();
        while($fila=$stmt->fetch(PDO::FETCH_NUM)) {
            $precio=$carro->total();
            $cliente_id=$fila[0];
            $fechaFormateada = date("d.m.y");
            $sql="INSERT INTO PEDIDOS (IDENTIFICADOR, cliente_id, PRECIO_TOTAL, CREADO) VALUES (SEC_INSERTAR_Pedido_id.NEXTVAL, :cliente_id, :precio, :fechaFormateada)";
            $st=$conexion->prepare($sql);
            $st->bindParam(':cliente_id', $cliente_id);
            $st->bindParam(':precio', $precio);
            $st->bindParam(':fechaFormateada', $fechaFormateada);
            $st->execute();

        }
    

        //Insertamos los detalles del pedido en la base de datos
        if($carro->total_items() > 0){
            $cartItems = $carro->contents();
            foreach($cartItems as $item){
                $idProducto = $item['IDENTIFICADOR'];
                $cantidad = $item['qty'];
                $sql="INSERT INTO ProductosPedido (OID_P, IDPRODUCTO, CANTIDAD) VALUES (SEC_INSERTAR_Pedido_id.CURRVAL, :IDPRODUCTO, :CANTIDAD)";
                $st=$conexion->prepare($sql);
                $st->bindParam(':idproducto', $idProducto);
                $st->bindParam(':cantidad', $cantidad);
                $st->execute();
            }
            //Si todo ha salido bien nos redirigimos hacia la pagina de pedido finalizado donde nos muestra nuestro id de pedido
            if(true){
                $consulta="SELECT IDENTIFICADOR FROM PEDIDOS";
                $res=$conexion->query($consulta);
                while($fila=$res->fetch(PDO::FETCH_NUM)){
                    $orderId=end($fila);
                }
                $carro->destroy();
                header("Location: pedidoRealizado.php?id= $orderId");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: checkout.php");
    }
}else{
    header("Location: shopping-page.php");
}?>