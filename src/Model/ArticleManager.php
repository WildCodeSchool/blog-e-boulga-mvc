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
        $statement = $this->pdo->query('SELECT * from article
                ORDER BY releaseDate DESC
                LIMIT 1');
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME );
        
        return $statement->fetch();
    }

    

    
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
