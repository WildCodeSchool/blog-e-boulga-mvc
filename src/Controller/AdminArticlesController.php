<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\ArticleManager;

class AdminArticlesController extends AbstractController
{
    public function index(): string
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->selectAll();

        return $this->twig->render('AdminArticles/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
