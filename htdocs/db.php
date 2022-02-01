<?php
const DB_USER = "root";
const DB_PASS = "";
const DB_INFO = "mysql:host=localhost;dbname=logrocho";

$_conexion = null;

/**
 * Obtiene la conexión con la base de datos
 *
 * @return PDO
 */
function getConexion()
{
    global $_conexion;

    if ($_conexion == null) {
        $_conexion = new PDO(DB_INFO, DB_USER, DB_PASS);
    }
    return $_conexion;
}
/**
 * 
 *
 * @param string $email
 * @param string $password
 * @return array|false
 */
function loginByCredentials(string $email, string $password)
{
    $stmt = getConexion()->prepare("SELECT * FROM user WHERE `email` = ? AND `password` = ?");
    $stmt->execute([$email, sha1($password)]);

    return $stmt->fetchAll();
}

function getRestauranteByEmail(string $usuario)
{
    return getConexion()->query("SELECT * FROM restaurante WHERE correo = '$usuario'");
}

function getRestauranteByID(string $codres)
{
    return getConexion()->query("SELECT * FROM restaurante WHERE SHA1(codres) = '$codres' LIMIT 1");
}

function cambiarPassRestaruante($clave, $codres)
{
    return getConexion()->query("UPDATE restaurante SET clave = '$clave' WHERE SHA1(codres) = '$codres'");
}

function addRestaurante(string $usuario, string $direccion, string $clave)
{
    $db = getConexion();
    $db->query("INSERT INTO restaurante (`correo`, `direccion`, `clave`) VALUES ('$usuario', '$direccion', '$clave')");
    return $db->lastInsertId();
}

/**
 * Obtiene todas las categorias
 *
 * @return PDOStatement
 */
function getCategorias()
{
    return getConexion()->query("SELECT * FROM categoria");
}

function getCategoria(string $codcat)
{
    return getConexion()->query("SELECT * FROM categoria WHERE SHA1(codcat) = '$codcat' LIMIT 1")->fetch();
}
/**
 * Obtiene una todos los productos de una categoria
 *
 * @param integer $idCategoria
 * @return PDOStatement
 */
function getProductosByCategoria(string $codcat)
{
    return getConexion()->query("SELECT * FROM producto WHERE SHA1(codcat) = '$codcat'");
}

/**
 * Obtiene un producto
 *
 * @param integer $codprod El ID del producto
 * @return array
 */
function getProducto(string $codprod)
{
    return getConexion()->query("SELECT * FROM producto WHERE SHA1(codprod) = '$codprod' LIMIT 1")->fetch();
}

/**
 * Quita stock a un producto
 *
 * @param integer $codprod
 * @param integer $cantidad la cantidad a quitar
 * @return void
 */
function quitarStock(string $codprod, int $cantidad)
{
    try {

        $producto = getProducto($codprod);

        /*
        if ($producto["stock"] == 0) {
            throw new Exception("No hay stock del producto");
        }*/

        $nuevaCantidad = $producto["stock"] - $cantidad;

        /*
        if ($nuevaCantidad < 0) {
            throw new Exception("La cantidad a comprar supera el stock disponible");
        }*/

        $sql = "UPDATE `producto` SET `stock`= $nuevaCantidad WHERE SHA1(codprod) = '$codprod'";

        return getConexion()->query($sql);
    } catch (\Throwable $th) {
        throw $th;
    }
}

/**
 * Crea un nuevo pedido
 *
 * @param string $fecha Fecha del pedido
 * @param boolean $enviado Si se ha enviado el pedido
 * @param integer $codres El codigo del restaurante
 * @return int el ID del pedido creado
 */
function nuevoPedido(string $fecha, bool $enviado, int $codres)
{
    //Bool a num para SQL
    $enviado = $enviado ? "1" : "0";

    $db = getConexion();

    $db->query("INSERT INTO pedido (fecha, enviado, codres) VALUES ('$fecha', $enviado, $codres)");
    return $db->lastInsertId();
}

/**
 * Añade un producto a un pedido
 *
 * @param integer $codped Codigo del pedido
 * @param integer $codprod Codigo del producto
 * @param integer $unidades Unidades del producto
 * @return void
 */
function addPorductoAPedido(string $codped, int $codprod, int $unidades)
{
    getConexion()->query("INSERT INTO pedido_producto (codped, codprod, unidades) VALUES ($codped, $codprod, $unidades)");
}


function getFullPedidosByRestaurante($codres)
{
    $pedidosPDO = getPedidosByRestaurante($codres);
    $pedidos = [];
    foreach ($pedidosPDO as $pedido) {
        $pedido["productos"] = [];

        $productos = getDetallesPedido($pedido["codped"]);

        foreach ($productos as $prodcuto) {
            $pedido["productos"][] = [
                "codprod" => $prodcuto["codprod"],
                "unidades" => $prodcuto["unidades"]
            ];
        }
        $pedidos[] = $pedido;
    }
    return $pedidos;
}

function getDetallesPedido($codped)
{
    return getConexion()->query("SELECT * FROM pedido_producto WHERE codped = '$codped'");
}

function getPedidosByRestaurante($codres)
{
    return getConexion()->query("SELECT * FROM pedido WHERE codres = '$codres'");
}
