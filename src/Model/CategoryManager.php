<?php

namespace App\Model;

use PDO;

class CategoryManager extends AbstractManager
{
    public const TABLE = 'category';
    public const CLASSNAME = "App\Model\CategoryModel";

    public function getAllCategory(): array
    {
        return $this->selectAll('categoryName');
    }

    public function create(string $name): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (categoryName, status) VALUES (:name, 1)");
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
