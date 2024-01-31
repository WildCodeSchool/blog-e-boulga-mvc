<?php

namespace App\Model;

class MainArticleModel
{
    private int $id = 1;
    private int $idArticle;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdArticle(): int
    {
        return $this->idArticle;
    }

    public function setIdArticle(int $idArticle): void
    {
        $this->idArticle = $idArticle;
    }
}
