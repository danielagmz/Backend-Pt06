<?php 
namespace  api\models\core;

class Database {
    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getConnection() {
        try {
            self::$instance = new \PDO(
                'mysql:host=' . SERVER . ';dbname=' . DATABASE . ';charset=utf8', 
                USER_DB, 
                PASS_DB
            );
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
        return self::$instance;
    }
}