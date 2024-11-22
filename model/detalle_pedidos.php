<?php
class DetallePedidos extends Conectar {
    // Obtener todos los detalles de los pedidos
    public function get_detalle_pedidos() {
        $conectar = parent::Conexion();
        parent::setnames();
        $sql = "SELECT dp.id_detalle, dp.id_pedido, dp.id_producto, dp.cantidad, dp.subtotal,
                       p.nombre AS producto_nombre, p.descripcion AS producto_descripcion, p.precio AS producto_precio,
                       u.nombre AS usuario_nombre
                FROM detalle_pedidos dp
                INNER JOIN productos p ON dp.id_producto = p.id_producto
                INNER JOIN pedidos pe ON dp.id_pedido = pe.id_pedido
                INNER JOIN usuarios u ON pe.id_usuario = u.id_usuario";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar un nuevo detalle de pedido
    public function insert_detalle_pedido($id_pedido, $id_producto, $cantidad, $subtotal) {
        $conectar = parent::Conexion();
        parent::setnames();
        $sql = "INSERT INTO detalle_pedidos (id_pedido, id_producto, cantidad, subtotal) VALUES (?, ?, ?, ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_pedido);
        $sql->bindValue(2, $id_producto);
        $sql->bindValue(3, $cantidad);
        $sql->bindValue(4, $subtotal);
        $sql->execute();
        return ["id" => $conectar->lastInsertId()];
    }

    // Eliminar un detalle de pedido
    public function delete_detalle_pedido($id_detalle) {
        $conectar = parent::Conexion();
        parent::setnames();
        $sql = "DELETE FROM detalle_pedidos WHERE id_detalle = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_detalle);
        $sql->execute();
        return ["resultado" => "Detalle de pedido eliminado"];
    }

    // Actualizar un detalle de pedido
    public function update_detalle_pedido($id_detalle, $id_pedido, $id_producto, $cantidad, $subtotal) {
        $conectar = parent::Conexion();
        parent::setnames();
        $sql = "UPDATE detalle_pedidos 
                SET id_pedido = ?, id_producto = ?, cantidad = ?, subtotal = ? 
                WHERE id_detalle = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_pedido);
        $sql->bindValue(2, $id_producto);
        $sql->bindValue(3, $cantidad);
        $sql->bindValue(4, $subtotal);
        $sql->bindValue(5, $id_detalle);
        $sql->execute();
        return ["resultado" => "Detalle de pedido actualizado"];
    }
}
?>
