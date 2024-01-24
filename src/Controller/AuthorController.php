<?php

namespace App\Controller;

use App\Model\AuthorManager;
class AuthorController extends AbstractController
{
    public function showAuthor() : string
    {
        $authorManager = new AuthorManager();
        $author = $authorManager->selectAll('lastName');

        return $this->twig->render('Item/show.html.twig', ['author' => $author]);
    }
}
