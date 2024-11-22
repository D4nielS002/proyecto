<?php
class Usuario extends Conectar {

    // Obtener todos los usuarios
    public function get_usuarios() {
        $conectar = parent::Conexion();
        parent::setnames();

        // Consulta para obtener todos los usuarios
        $sql = "SELECT u.id_usuario, u.nombre, u.correo, u.telefono
                FROM usuarios u";
        $sql = $conectar->prepare($sql);
        $sql->execute();

        // Devolver los resultados
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar un nuevo usuario
    public function insert_usuario($nombre, $correo, $telefono) {
        $conectar = parent::Conexion();
        parent::setnames();

        // Consulta para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, correo, telefono) VALUES (?, ?, ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $correo);
        $sql->bindValue(3, $telefono);
        $sql->execute();

        // Devolver el ID del nuevo usuario insertado
        return ["id" => $conectar->lastInsertId()];
    }

    // Eliminar un usuario por ID
    public function delete_usuario($id) {
        $conectar = parent::Conexion();
        parent::setnames();

        // Consulta para eliminar un usuario por ID
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();

        // Devolver mensaje de éxito
        return ["resultado" => "Usuario eliminado"];
    }

    // Actualizar un usuario
    public function update_usuario($id, $nombre, $correo, $telefono) {
        $conectar = parent::Conexion();
        parent::setnames();

        // Consulta para actualizar los datos de un usuario
        $sql = "UPDATE usuarios SET nombre = ?, correo = ?, telefono = ? WHERE id_usuario = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $correo);
        $sql->bindValue(3, $telefono);
        $sql->bindValue(4, $id);
        $sql->execute();

        // Devolver mensaje de éxito
        return ["resultado" => "Usuario actualizado"];
    }
}
?>
