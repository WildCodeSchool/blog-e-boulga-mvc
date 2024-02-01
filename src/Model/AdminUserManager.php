<?php

namespace App\Model;

class AdminUserManager extends AbstractManager
{
    public const TABLE = 'user';
    public const CLASSNAME = 'App\Model\AdminUserModel';

    public function selectByLogin(string $login): AdminUserModel|false
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM " . static::TABLE . " WHERE login = :login"
        );
        $statement->bindValue('login', $login, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, static::CLASSNAME);
        $statement->execute();

        return $statement->fetch();
    }
}
