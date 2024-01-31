<?php

namespace App\Model;

use PDO;

class CategoryManager extends AbstractManager
{
    public const TABLE = 'category';
    public const CLASSNAME = "App\Model\CategoryModel";

    public function getAllCategory(): array
    {
        $statement = $this->pdo->query('SELECT * FROM category ORDER BY categoryName ASC');
        $statement->setFetchMode(PDO::FETCH_CLASS, static::CLASSNAME);
        return $statement->fetchAll();
    }
}
