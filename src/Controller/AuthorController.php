<?php

namespace App\Controller;

use App\Model\AuthorManager;

class AuthorController extends AbstractController
{
    public function show(): string
    {
        $author = new AuthorManager();
        $authors = $author->selectAll();

        return $this->twig->render('AboutUs/index.html.twig', ['authors' => $authors]);
    }
}
