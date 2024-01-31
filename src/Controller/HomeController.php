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
        $allArticles = $articleManager->getAllArticles();

        return $this->twig->render('Home/index.html.twig', [
                'mainArticle' => $mainArticle,
                'relatedArticles' => $relatedArticles,
                'allArticles' => $allArticles
                ]);
    }
}
