<?php

namespace App\Model;

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
        $mainArticle = $this->getMainArticleId();

        $statement = $this->pdo->query('SELECT * FROM article WHERE id = ' . $mainArticle->getIdArticle());
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);

        return $statement->fetch();
    }

    public function getAllArticles()
    {
        $statement = $this->pdo->query('SELECT * FROM article WHERE status = 2 ORDER BY releaseDate DESC LIMIT 15');
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);
        return $statement->fetchAll();
    }

    public function setMainArticle(int $id)
    {
        $statement = $this->pdo->prepare('UPDATE mainArticle SET idArticle = :id WHERE id = 1');
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getMainArticleId(): MainArticleModel
    {
        $statement = $this->pdo->query('SELECT idArticle FROM mainArticle WHERE id = 1');
        $statement->setFetchMode(PDO::FETCH_CLASS, 'App\Model\MainArticleModel');
        return $statement->fetch();
    }
}
