<?php
header('Content-Type: application/json');
require_once("../config/conexion.php");
require_once("../model/detalle_pedidos.php");

$detalle_pedido = new DetallePedidos();
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["op"]) {
    case 'GetDetallePedidos':
        $datos = $detalle_pedido->get_detalle_pedidos();
        echo json_encode($datos);
        break;

    case 'InsertDetallePedido':
        $id_pedido = $body["id_pedido"];
        $id_producto = $body["id_producto"];
        $cantidad = $body["cantidad"];
        $subtotal = $body["subtotal"];
        $result = $detalle_pedido->insert_detalle_pedido($id_pedido, $id_producto, $cantidad, $subtotal);
        echo json_encode($result);
        break;

    case 'DeleteDetallePedido':
        $id_detalle = $body["id_detalle"];
        $result = $detalle_pedido->delete_detalle_pedido($id_detalle);
        echo json_encode($result);
        break;

    case 'UpdateDetallePedido':
        $id_detalle = $body["id_detalle"];
        $id_pedido = $body["id_pedido"];
        $id_producto = $body["id_producto"];
        $cantidad = $body["cantidad"];
        $subtotal = $body["subtotal"];
        $result = $detalle_pedido->update_detalle_pedido($id_detalle, $id_pedido, $id_producto, $cantidad, $subtotal);
        echo json_encode($result);
        break;
}
?>
