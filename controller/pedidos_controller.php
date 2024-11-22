<?php
header('Content-Type: application/json');
require_once("../config/conexion.php");
require_once("../model/pedidos.php");

$pedido = new Pedidos();
$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["op"]) {
    case 'GetPedidos':
        $datos = $pedido->get_pedidos();
        echo json_encode($datos);
        break;

    case 'InsertPedido':
        $idUsuario = $body["id_usuario"];  // Asegúrate de que estos campos estén presentes
        $fecha = $body["fecha"];            // Formato de fecha YYYY-MM-DD
        $estado = $body["estado"];          // Estado del pedido (por ejemplo: 'pendiente', 'completado')

        // Verificar que los datos estén presentes
        if (empty($idUsuario) || empty($fecha) || empty($estado)) {
            echo json_encode(["error" => "Faltan datos necesarios (id_usuario, fecha, estado)"]);
            break;
        }

        $result = $pedido->insert_pedido($idUsuario, $fecha, $estado);
        echo json_encode($result);
        break;

    case 'DeletePedido':
        $idPedido = $body["id_pedido"];
        $result = $pedido->delete_pedido($idPedido);
        echo json_encode($result);
        break;

    case 'UpdatePedido':
        $idPedido = $body["id_pedido"];
        $idUsuario = $body["id_usuario"];
        $fecha = $body["fecha"];
        $estado = $body["estado"];
        
        // Verificar que los datos estén presentes
        if (empty($idPedido) || empty($idUsuario) || empty($fecha) || empty($estado)) {
            echo json_encode(["error" => "Faltan datos necesarios (id_pedido, id_usuario, fecha, estado)"]);
            break;
        }

        $result = $pedido->update_pedido($idPedido, $idUsuario, $fecha, $estado);
        echo json_encode($result);
        break;
}
?>
