<?php

namespace App\Controller;

use App\Model\ArticleManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $articleManager = new ArticleManager();
        $mainArticle = $articleManager->getMainArticle();
        $relatedArticles = $articleManager->getRelatedArticles();
        return $this->twig->render('Home/index.html.twig', [
                'mainArticle' => $mainArticle,
                'relatedArticles' => $relatedArticles
                ]);
    }
}
