<!--Distintos métodos de la clase Cart y sus usos.

contents() = Devuelve el contenido del carrito en forma de array
get_item() = Devuelve un artículo específico del carrito
total_items() = Devuelve el número de elementos total del carrito
total() = Devuelve el precio final del carrito
insert() = Inserta un nuevo elemento en el carrito y lo guarda en sesión
update() = Actualiza el carrito
remove() = Elimina un elemento del carrito
destroy() = Vacía el carro y destruye la sesión    --> 

<?php session_start();
class funciones_carrito {
    protected $contenido = array();
    
    public function __construct(){
        // Obtiene el carrito de la sesión
        $this->contenido = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
        if ($this->contenido === NULL){
            // Establece valores base
            $this->contenido = array('cart_total' => 0, 'total_items' => 0);
        }
    }
    
    // Devuelve el carrito completo 
    public function contents(){
        // Almacena el nuevo carrito
        $carro = array_reverse($this->contenido);

        // Elimina propiedades para evitar problemas
        unset($carro['total_items']);
        unset($carro['cart_total']);

        return $carro;
    }
    
    // Devuelve los detalles de un producto a partir de su id
    public function get_item($productoID){
        return (in_array($productoID, array('total_items', 'cart_total'), TRUE) OR ! isset($this->contenido[$productoID]))
            ? FALSE
            : $this->contenido[$productoID];
    }
    
    // Devuelve el total de elementos
    public function total_items(){
        return $this->contenido['total_items'];
    }
    
    // Devuelve el precio total
    public function total(){
        return $this->contenido['cart_total'];
    }
    
    // Inserta productos en el carrito y los guarda en la sesión
    public function insert($producto = array()){
        if(!is_array($producto) OR count($producto) === 0){
            return FALSE;
        }else{
            if(!isset($producto['IDENTIFICADOR'], $producto['NOMBRE'], $producto['PRECIO'], $producto['qty'])){
                return FALSE;
            }else{
                // Inserta un producto
                //Prepara la Cantidad
                $producto['qty'] = (float) $producto['qty'];
                if($producto['qty'] == 0){
                    return FALSE;
                }
                // Prepara el precio
                $producto['PRECIO'] = (float) $producto['PRECIO'];
                // Crea un identificador único
                $nuevoID = md5($producto['IDENTIFICADOR']);
                // Coge la cantidad y si tenía una anterior, la añade
                $old_qty = isset($this->contenido[$nuevoID]['qty']) ? (int) $this->contenido[$nuevoID]['qty'] : 0;
                // Actualiza el producto con los nuevos id y cantidad
                $producto['rowid'] = $nuevoID;
                $producto['qty'] += $old_qty;
                $this->contenido[$nuevoID] = $producto;
                
                // Guarda un producto del carrito
                if($this->save_cart()){
                    return isset($nuevoID) ? $nuevoID : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }
    
    // Actualiza el carrito
    public function update($producto = array()){
        if (!is_array($producto) OR count($producto) === 0){
            return FALSE;
        }else{
            if (!isset($producto['rowid'], $this->contenido[$producto['rowid']])){
                return FALSE;
            }else{
                // Cantidad
                if(isset($producto['qty'])){
                    $producto['qty'] = (float) $producto['qty'];
                    // Elimina el producto del carrito si la cantidad es 0
                    if ($producto['qty'] == 0){
                        unset($this->contenido[$producto['rowid']]);
                        return TRUE;
                    }
                }
                
                // Coge el producto para actualizarlo
                $keys = array_intersect(array_keys($this->contenido[$producto['rowid']]), array_keys($producto));
                // Precio
                if(isset($producto['PRECIO'])){
                    $producto['PRECIO'] = (float) $producto['PRECIO'];
                }
                // El id y el nombre no se pueden modificar
                foreach(array_diff($keys, array('IDENTIFICADOR', 'NOMBRE')) as $key){
                    $this->contenido[$producto['rowid']][$key] = $producto[$key];
                }
                // Guarda los datos del carrito
                $this->save_cart();
                return TRUE;
            }
        }
    }
    
    // Guarda el carrito en la sesion
    protected function save_cart(){
        $this->contenido['total_items'] = $this->contenido['cart_total'] = 0;
        foreach ($this->contenido as $key => $val){
            // Asegura que tiene los datos correctos
            if(!is_array($val) OR !isset($val['PRECIO'], $val['qty'])){
                continue;
            }
     
            $this->contenido['cart_total'] += ($val['PRECIO'] * $val['qty']);
            $this->contenido['total_items'] += $val['qty'];
            $this->contenido[$key]['subtotal'] = ($this->contenido[$key]['PRECIO'] * $this->contenido[$key]['qty']);
        }
        
        // Si el carrito está vacío lo borra de la sesión
        if(count($this->contenido) <= 2){
            unset($_SESSION['cart_contents']);
            return FALSE;
        }else{
            $_SESSION['cart_contents'] = $this->contenido;
            return TRUE;
        }
    }
    
    // Elimina un producto del carrito
     public function remove($productoID){
        // unset & save
        unset($this->contenido[$productoID]);
        $this->save_cart();
        return TRUE;
     }
     
    // Vacia el carrito y destruye la sesión
    public function destroy(){
        $this->contenido = array('cart_total' => 0, 'total_items' => 0);
        unset($_SESSION['cart_contents']);
    }
}