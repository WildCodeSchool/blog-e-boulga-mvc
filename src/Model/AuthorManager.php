<?php

namespace App\Model;

use PDO;

class AuthorManager extends AbstractManager
{
    public const TABLE = 'author';
    public const CLASSNAME = "App\Model\AuthorModel";

    /* Récupération des infos concernant tous les authors */
    public function getAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT u.firstName, u.lastName, a.fullDescription, a.linkedinUrl, a.githubUrl, a.websiteUrl,
        a.imgSrc, a.userId FROM author as a INNER JOIN user as u ON u.id = a.userId';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_CLASS, static::CLASSNAME);
    }

    /* Récupération des infos concernant un author */
    public function getById(int $id): AuthorModel|false
    {
        $query = 'SELECT u.firstName, u.lastName, a.shortDescription,
        a.imgSrc, a.userId FROM author as a INNER JOIN user as u ON u.id = a.userId WHERE a.id=:id';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);
        $statement->execute();

        return $statement->fetch();
    }
}
