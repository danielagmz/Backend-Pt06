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
        $order = strtoupper($order);
        if (!BaseTrait::checkOption($order, ['ASC', 'DESC'])) {
            return self::jsonResponse(['error' => 'Invalid order'], 400);
        }

        $filter = BaseTrait::test_input($filter);

        $data = Articles::getAllArticles($filter, $order);

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

    public static function getUserArticles($identifier,$filter = '', $order = 'ASC')
    {
        //validacion del identificador (username o id)
        if (filter_var($identifier, FILTER_VALIDATE_INT)) {
            $id_user = $identifier;
        } else if (is_string($identifier)) {
            $user = Usuaris::getUserByUsername($identifier);
            if ($user == null) {
                return self::jsonResponse(['error' => 'User not found'], 404);
            } else {
                $id_user = $user->getId();
            }
        } else {
            return self::jsonResponse(['error' => 'Invalid user identifier'], 400);
        }
        // validacion de los query params
        $order = strtoupper($order);
        if (!BaseTrait::checkOption($order, ['ASC', 'DESC'])) {
            return self::jsonResponse(['error' => 'Invalid order'], 400);
        }

        $filter = BaseTrait::test_input($filter);

        $data = Articles::getUserArticles($filter, $id_user, $order);
        $articles = self::convertToArray($data['articles']);
        $total = $data['total'];

        if ($total == 0) {
            return self::jsonResponse(['articles' => [], 'total' => 0], 200,204);
        }

        $response = [
            'articles' => $articles,
            'total' => $total
        ];

        return self::jsonResponse($response);
    }
}
