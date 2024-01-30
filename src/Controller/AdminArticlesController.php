<?php

namespace App\Controller;

use App\Controller\AbstractController;

class AdminArticlesController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('AdminArticles/index.html.twig');
    }
}
