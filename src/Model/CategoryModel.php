<?php

namespace App\Model;

use App\Model\AbstractManager;

class CategoryModel
{
    private int $id;
    private ?string $categoryName;
    private ?int $status;


    public function getId(): int
    {
        return $this->id;
    }
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(?string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}
