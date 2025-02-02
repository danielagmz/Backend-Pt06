<?php

namespace models;

require_once 'core/Database.php';

use api\models\core\Database;

class Tokens
{
    private static $conn;
    private static function initializeConnection()
    {
        if (!self::$conn) {
            self::$conn = Database::getConnection();
        }
    }

    public static function saveRefreshToken($user_id, $refresh_token,$type,$exp)
    {
        self::initializeConnection();
        try {
            $sql = "INSERT INTO tokens (user_id, token, type,tokenExp) VALUES (:id, :token, :type, :exp)";
            $stmt = self::$conn->prepare($sql);
            $stmt->execute(array(':id' => $user_id, ':token' => $refresh_token, ':type' => $type, ':exp' => $exp));
            if ($stmt->rowCount() == 0) {
                return false;
            }
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function getRefreshToken($user_id) {
        self::initializeConnection();
        try {
            $sql = "SELECT token FROM tokens WHERE user_id = :id AND type = 'refreshTK'";
            $stmt = self::$conn->prepare($sql);
            $stmt->execute(array(':id' => $user_id));
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($result) {
                return $result['token'];
            } else {
                return null;
            }
        } catch (\PDOException $e) {
            return null;
        }
    }

    public static function deleteRefreshToken($user_id) {
        self::initializeConnection();
        try {
            $sql = "DELETE FROM tokens WHERE user_id = :id AND type = 'refreshTK'";
            $stmt = self::$conn->prepare($sql);
            $stmt->execute(array(':id' => $user_id));
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
