<?php

namespace App\Model;

use App\UploadFile;
use PDO;

class ArticleManager extends AbstractManager
{
    public const TABLE = 'article';
    public const CLASSNAME = "App\Model\ArticleModel";

    public function getArticle(int $id): ArticleModel|false
    {
        return $this->selectOneById($id);
    }

    public function getMainArticle()
    {
        $statement = $this->pdo->query('SELECT * FROM article ORDER BY releaseDate DESC LIMIT 1');
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);

        return $statement->fetch();
    }

    public function getRelatedArticles()
    {
        $statement = $this->pdo->query('SELECT * FROM article ORDER BY releaseDate DESC LIMIT 2 OFFSET 1');
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);
        return $statement->fetchAll();
    }

    public function getAllArticles()
    {
        $statement = $this->pdo->query('SELECT * FROM article ORDER BY releaseDate DESC LIMIT 15 OFFSET 3');
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);
        return $statement->fetchAll();
    }
}
