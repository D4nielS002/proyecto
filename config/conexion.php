<?php
class Conectar {

    protected $dbh;

    protected function Conexion() {
        try {
            // Cambia 'gestión_pedidos' por el nombre de tu base de datos
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=gestion_pedidos", "root", "");
            return $conectar;
        } catch (Exception $e) {
            // Mostrar un mensaje de error si la conexión falla
            print "Error de conexión: " . $e->getMessage();
        }
    }

    // Configurar la conexión para aceptar caracteres especiales como tildes o ñ
    public function setnames() {
        return $this->dbh->query("SET NAMES 'utf8mb4'");
    }
}
?>
