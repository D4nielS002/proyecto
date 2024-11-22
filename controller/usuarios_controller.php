<?php
header('Content-Type: application/json');
require_once("../config/conexion.php");
require_once("../model/usuarios.php");

// Crear instancia de la clase Usuario
$usuario = new Usuario();
$body = json_decode(file_get_contents("php://input"), true);

// Lógica para manejar las operaciones de usuarios
switch ($_GET["op"]) {

    // Obtener todos los usuarios
    case 'GetUsuarios':
        $datos = $usuario->get_usuarios();
        echo json_encode($datos);
        break;

    // Insertar un nuevo usuario
    case 'InsertUsuario':
        // Validar que los parámetros necesarios estén presentes
        if (empty($body["nombre"]) || empty($body["correo"]) || empty($body["telefono"])) {
            echo json_encode(["error" => "Faltan datos necesarios (nombre, correo, telefono)"]);
            break;
        }
        $nombre = $body["nombre"];
        $correo = $body["correo"];
        $telefono = $body["telefono"];
        try {
            $result = $usuario->insert_usuario($nombre, $correo, $telefono);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al insertar usuario: " . $e->getMessage()]);
        }
        break;

    // Eliminar un usuario por ID
    case 'DeleteUsuario':
        // Validar que el ID esté presente
        if (empty($body["id_usuario"])) {
            echo json_encode(["error" => "Falta el ID del usuario"]);
            break;
        }
        $id = $body["id_usuario"];
        try {
            $result = $usuario->delete_usuario($id);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al eliminar usuario: " . $e->getMessage()]);
        }
        break;

    // Actualizar un usuario
    case 'UpdateUsuario':
        // Validar que los parámetros necesarios estén presentes
        if (empty($body["id_usuario"]) || empty($body["nombre"]) || empty($body["correo"]) || empty($body["telefono"])) {
            echo json_encode(["error" => "Faltan datos necesarios (ID, nombre, correo, telefono)"]);
            break;
        }
        $id = $body["id_usuario"];
        $nombre = $body["nombre"];
        $correo = $body["correo"];
        $telefono = $body["telefono"];
        try {
            $result = $usuario->update_usuario($id, $nombre, $correo, $telefono);
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(["error" => "Error al actualizar usuario: " . $e->getMessage()]);
        }
        break;

    // Caso por defecto si la operación no es válida
    default:
        echo json_encode(array("mensaje" => "Operación no válida"));
        break;
}
?>
