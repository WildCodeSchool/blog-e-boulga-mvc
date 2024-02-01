<?php

namespace App\Model;

use PDO;

class CategoryManager extends AbstractManager
{
    public const TABLE = 'category';
    public const CLASSNAME = "App\Model\CategoryModel";

    public function getAllCategory(): array
    {
        return $this->selectAll();
    }
}
