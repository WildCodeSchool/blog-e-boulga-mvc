<?php

namespace App\Controller;

use App\Model\AuthorManager;

class AuthorController extends AbstractController
{
    public function index(): string
    {
        $author = new AuthorManager();
        $authors = $author->getAll();

        return $this->twig->render('AboutUs/index.html.twig', [
            'authors' => $authors,
            'page' => 'about',
        ]);
    }
}
