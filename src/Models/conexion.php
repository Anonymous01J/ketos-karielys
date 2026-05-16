<?php
namespace clientepc\kesto\Models;

use PDO;
use PDOException;

class Conexion extends PDO {

    public function __construct() {
        $host   = 'localhost';
        $user   = 'root';
        $pass   = '';
        $dbname = 'kesto';
        try {
            parent::__construct(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $pass
            );
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error en la conexión: ' . $e->getMessage());
        }
    }
}
