<?php
class Producto extends Conectar {

    public function get_productos() {
        $conectar = parent::Conexion();
        parent::setnames();
        // Consulta para obtener todos los productos
        $sql = "SELECT id_producto, nombre, descripcion, precio, Stock, Categoria FROM productos";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_producto($nombre, $descripcion, $precio, $stock, $categoria) {
        $conectar = parent::Conexion();
        parent::setnames();
        // Consulta para insertar un nuevo producto
        $sql = "INSERT INTO productos (nombre, descripcion, precio, Stock, Categoria) VALUES (?, ?, ?, ?, ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $precio);
        $sql->bindValue(4, $stock);
        $sql->bindValue(5, $categoria);
        $sql->execute();
        return ["id" => $conectar->lastInsertId()];
    }

    public function delete_producto($id) {
        $conectar = parent::Conexion();
        parent::setnames();
        // Consulta para eliminar un producto por ID
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return ["resultado" => "Producto eliminado"];
    }

    public function update_producto($id, $nombre, $descripcion, $precio, $stock, $categoria) {
        $conectar = parent::Conexion();
        parent::setnames();
        // Consulta para actualizar un producto
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, Stock = ?, Categoria = ? WHERE id_producto = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $precio);
        $sql->bindValue(4, $stock);
        $sql->bindValue(5, $categoria);
        $sql->bindValue(6, $id);
        $sql->execute();
        return ["resultado" => "Producto actualizado"];
    }
}
?>
