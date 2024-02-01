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
        $allArticles = $articleManager->getAllArticles();
      
        $fusionArticles = array_merge([$mainArticle], $allArticles);
      
        return $this->twig->render('Home/index.html.twig', [
                'mainArticle' => $mainArticle,
                'fusion' => $fusionArticles,
                ]);
    }
}
