<?php 
namespace Models\core;

class Database {
    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getConnection() {
        global $conn;
        try {
            self::$instance = $conn;
        } catch (\PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
        return self::$instance;
    }
}