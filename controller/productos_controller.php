<?php
header('Content-Type: application/json');
require_once("../config/conexion.php");
require_once("../model/productos.php");

$producto = new Producto();
$body = json_decode(file_get_contents("php://input"), true);

// Validación para asegurarse de que se haya pasado la operación
if (!isset($_GET["op"])) {
    echo json_encode(["error" => "Operación no especificada"]);
    exit();
}

switch ($_GET["op"]) {
    // Obtener todos los productos
    case 'GetProductos':
        try {
            $datos = $producto->get_productos();
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al obtener productos: " . $e->getMessage()]);
        }
        break;

    // Insertar un nuevo producto
    case 'InsertProducto':
        // Validación de datos recibidos
        if (empty($body["nombre"]) || empty($body["descripcion"]) || empty($body["precio"]) || empty($body["Stock"]) || empty($body["Categoria"])) {
            echo json_encode(["error" => "Faltan datos necesarios (nombre, descripcion, precio, stock, categoria)"]);
            break;
        }
        try {
            $nombre = $body["nombre"];
            $descripcion = $body["descripcion"];
            $precio = $body["precio"];
            $stock = $body["Stock"];
            $categoria = $body["Categoria"];
            $result = $producto->insert_producto($nombre, $descripcion, $precio, $stock, $categoria);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al insertar producto: " . $e->getMessage()]);
        }
        break;

    // Eliminar un producto por ID
    case 'DeleteProducto':
        // Validación de ID recibido
        if (empty($body["id_producto"])) {
            echo json_encode(["error" => "Falta el ID del producto"]);
            break;
        }
        try {
            $id = $body["id_producto"];
            $result = $producto->delete_producto($id);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al eliminar producto: " . $e->getMessage()]);
        }
        break;

    // Actualizar un producto
    case 'UpdateProducto':
        // Validación de datos recibidos
        if (empty($body["id_producto"]) || empty($body["nombre"]) || empty($body["descripcion"]) || empty($body["precio"]) || empty($body["Stock"]) || empty($body["Categoria"])) {
            echo json_encode(["error" => "Faltan datos necesarios (id_producto, nombre, descripcion, precio, stock, categoria)"]);
            break;
        }
        try {
            $id = $body["id_producto"];
            $nombre = $body["nombre"];
            $descripcion = $body["descripcion"];
            $precio = $body["precio"];
            $stock = $body["Stock"];
            $categoria = $body["Categoria"];
            $result = $producto->update_producto($id, $nombre, $descripcion, $precio, $stock, $categoria);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al actualizar producto: " . $e->getMessage()]);
        }
        break;

    // Caso por defecto si la operación no es válida
    default:
        echo json_encode(["error" => "Operación no válida"]);
        break;
}
?>
