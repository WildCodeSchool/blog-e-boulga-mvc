<?php

namespace App\Model;

use PDO;

use function Amp\Promise\all;

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

    public function upDateArticle($article)
    {
        $statement = $this->pdo->prepare('UPDATE article 
                                        SET `authorId` = :authorId,
                                            `categoryId`=:categoryId,
                                            `articleTitle` = :articleTitle,
                                            `homeTitle` = :homeTitle,
                                            `imgSrc` = :imgSrc,
                                            `altImg` = :altImg,
                                            `homePreview` = :homePreview,
                                            `introduction` = :introduction,
                                            `detail` = :detail,
                                            `description` = :`description`, 
                                            `status` = :`status`,
                                            `updateAt` = :`update`,
                                        WHERE id=:id');

        $statement->bindValue('id', $article['id'], PDO::PARAM_INT);
        $statement->bindValue(':authoId', $article['authorId'], PDO::PARAM_STR);
        $statement->bindValue(':categoryId', $article['categoryId'], PDO::PARAM_STR);
        $statement->bindValue(':articleTitle', $article['articleTitle'], PDO::PARAM_STR);
        $statement->bindValue(':homeTitle', $article['homeTitle'], PDO::PARAM_STR);
        $statement->bindValue(':imgSrc', $article['imgSrc'], PDO::PARAM_STR);
        $statement->bindValue(':altImg', $article['altImg'], PDO::PARAM_STR);
        $statement->bindValue(':homePreview', $article['homePreview'], PDO::PARAM_STR);
        $statement->bindValue(':introduction', $article['introduction'], PDO::PARAM_STR);
        $statement->bindValue(':detail', $article['detail'], PDO::PARAM_STR);
        $statement->bindValue(':description', $article['description'], PDO::PARAM_STR);
        $statement->bindValue(':releaseDate', $article['releaseDate'], PDO::PARAM_STR);
        $statement->bindValue(':status', $article['status'], PDO::PARAM_STR);
        $statement->bindValue(':updateAt', $article['update'], PDO::PARAM_STR);
        $statement->execute();
    }
}
