<?php

namespace Models;
use api\models\core\Database;
use api\models\Usuari;
class Usuaris
{
    private static $conn=null;

    private static function initializeConnection()
    {
        if (!self::$conn) {
            self::$conn = Database::getConnection();
        }
    }

    public static function getUser($userId)
    {
        self::initializeConnection();
        try {
            $query = "SELECT * FROM usuaris WHERE id = :userId";
            $statement = self::$conn->prepare($query);
            $statement->execute([':userId' => $userId]);
            $userData = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($userData) {
                return new Usuari(
                    $userData['id'], 
                    $userData['usuario'], 
                    $userData['email'], 
                    $userData['pass'], 
                    $userData['bio'], 
                    $userData['avatar'], 
                    $userData['banner'], 
                    $userData['admin'], 
                    $userData['socialProv'], 
                    $userData['created_at'], 
                    $userData['updated_at']
                );
            }

            return null;
        } catch (\PDOException $exception) {
            error_log("Database error: " . $exception->getMessage());
            return null;
        }
    }

    public static function getUserByUsername($username)
    {
        self::initializeConnection();
        try {
            $query = "SELECT * FROM usuaris WHERE usuario = :username";
            $statement = self::$conn->prepare($query);
            $statement->execute([':username' => $username]);
            $userData = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($userData) {
                return new Usuari(
                    $userData['id'], 
                    $userData['usuario'], 
                    $userData['email'], 
                    $userData['pass'], 
                    $userData['bio'], 
                    $userData['avatar'], 
                    $userData['banner'], 
                    $userData['admin'], 
                    $userData['socialProv'], 
                    $userData['created_at'], 
                    $userData['updated_at']
                );
            }

            return null;
        } catch (\PDOException $exception) {
            error_log("Database error: " . $exception->getMessage());
            return null;
        }
    }
}
