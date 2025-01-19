<?php

namespace Models;
require_once 'server/models/core/Database.php';
use Models\core\Database;
use Models\entities\Article;

class Articles
{
    private static $conn;
    private static function initializeConnection()
    {
        if (!self::$conn) {
            self::$conn = Database::getConnection();
        }
    }
    public static function getAllArticles($filter, $order)
    {
        self::initializeConnection();
        try {
            $sql = "SELECT * FROM articles WHERE titol RLIKE :filter ORDER BY titol $order";
            $stmt = self::$conn->prepare($sql);

            // Usamos bindValue para asegurarnos de que estos parámetros sean tratados como enteros
            $stmt->bindValue(':filter', $filter, \PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $articles = [];

            foreach ($results as $result) {
                $articles[] = new Article(
                    $result['id'],
                    $result['titol'],
                    $result['cos'],
                    $result['data_creacio'],
                    $result['data_modificacio'],
                    $result['autor']
                );
            };

            return ['articles' => $articles, 'total' => $stmt->rowCount()];
        } catch (\PDOException $e) {
            return [];
        }
    }

    public static function getArticle($id)
    {
        try {
            $sql = "SELECT * FROM articles WHERE id = :id";
            $stmt = self::$conn->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $articleData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($articleData) {
                return new Article(
                    $articleData['id'],
                    $articleData['titol'],
                    $articleData['cos'],
                    $articleData['data_creacio'],
                    $articleData['data_modificacio'],
                    $articleData['autor']
                );
            }

            return null;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public static function getUserArticles($limit, $offset, $filter, $id_user, $order)
    {
        try {
            $sql = "SELECT * FROM articles WHERE titol RLIKE :filter AND autor = :user  ORDER BY titol $order LIMIT :limit OFFSET :offset";
            $stmt = self::$conn->prepare($sql);

            // Usamos bindValue para asegurarnos de que estos parámetros sean tratados como enteros
            $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
            $stmt->bindValue(':filter', $filter, \PDO::PARAM_STR);
            $stmt->bindValue(':user', $id_user, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $articles = [];

            foreach ($result as $article) {
                $articles[] = new Article(
                    $article['id'],
                    $article['titol'],
                    $article['cos'],
                    $article['data_creacio'],
                    $article['data_modificacio'],
                    $article['autor']
                );
            };
            return ['articles' => $articles, 'total' => $stmt->rowCount()];
        } catch (\PDOException $e) {
            return [];
        }
    }
}
