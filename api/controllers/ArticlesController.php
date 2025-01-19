<?php

namespace api\controllers;

use Models\Articles;
use api\Controllers\core\BaseController;
use api\core\BaseTrait;
use Models\Usuaris;

class ArticlesController extends BaseController
{

    public static function getAllArticles($filter = '', $order = 'ASC')
    {
        if (!BaseTrait::checkOption($order, ['ASC', 'DESC'])) {
            return self::jsonResponse(['error' => 'Invalid order'], 400);
        }

        $filter = BaseTrait::test_input($filter);

        $data = Articles::getAllArticles($filter, 'ASC');

        $articles = self::convertToArray($data['articles']);
        $total = $data['total'];

        if ($total == 0) {
            return self::jsonResponse(['articles' => [], 'total' => 0], 200);
        }

        $response = [
            'articles' => $articles,
            'total' => $total
        ];

        return self::jsonResponse($response);
    }

    public static function getArticle($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            return self::jsonResponse(['error' => 'Invalid ID'], 400);
        }
        $data = Articles::getArticle($id);
        if ($data) {
            $article = $data->toArray();
            return self::jsonResponse($article);
        } else {
            return self::jsonResponse(['error' => 'not found'], 404);
        }
    }

    public static function getUserArticles($identifier)
    {
        if (filter_var($identifier, FILTER_VALIDATE_INT)) {
            $id_user = $identifier;
        } else if (is_string($identifier)) {
            $user = Usuaris::getUserByUsername($identifier);
            if ($user == null) {
                return self::jsonResponse(['error' => 'User not found' . $identifier], 404);
            } else {
                $id_user = $user->getId();
            }
        } else {
            return self::jsonResponse(['error' => 'Invalid user identifier'], 400);
        }

        $data = Articles::getUserArticles('', $id_user, 'ASC');
        $articles = self::convertToArray($data['articles']);
        $total = $data['total'];

        if ($total == 0) {
            return self::jsonResponse(['articles' => [], 'total' => 0], 204);
        }

        $response = [
            'articles' => $articles,
            'total' => $total
        ];

        return self::jsonResponse($response);
    }

    public static function getUserArticlesbyUsername($username) {}
}
