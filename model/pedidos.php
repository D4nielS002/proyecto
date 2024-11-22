<?php
class Pedidos extends Conectar {

// Obtener todos los pedidos
public function get_pedidos() {
    $conectar = parent::Conexion();
    parent::setnames();
    $sql = "SELECT * FROM pedidos";
    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

// Insertar un nuevo pedido
public function insert_pedido($idUsuario, $fecha, $estado) {
    $conectar = parent::Conexion();
    parent::setnames();
    $sql = "INSERT INTO pedidos (id_usuario, fecha, estado) VALUES (?, ?, ?)";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $idUsuario);
    $sql->bindValue(2, $fecha); // Agregar fecha al insertar
    $sql->bindValue(3, $estado); // Agregar estado al insertar
    $sql->execute();
    return ["id" => $conectar->lastInsertId()];
}

// Eliminar un pedido
public function delete_pedido($idPedido) {
    $conectar = parent::Conexion();
    parent::setnames();
    $sql = "DELETE FROM pedidos WHERE id_pedido = ?";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $idPedido);
    $sql->execute();
    return ["resultado" => "Pedido eliminado"];
}

// Actualizar un pedido
public function update_pedido($idPedido, $idUsuario, $fecha, $estado) {
    $conectar = parent::Conexion();
    parent::setnames();
    $sql = "UPDATE pedidos SET id_usuario = ?, fecha = ?, estado = ? WHERE id_pedido = ?";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $idUsuario);
    $sql->bindValue(2, $fecha); // Actualizar fecha
    $sql->bindValue(3, $estado); // Actualizar estado
    $sql->bindValue(4, $idPedido);
    $sql->execute();
    return ["resultado" => "Pedido actualizado"];
}
}
?>