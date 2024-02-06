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

        foreach ($allArticles as $key => $article) {
            if ($article->getId() === $mainArticle->getId()) {
                array_splice($allArticles, $key, 1);
            }
        }

        $relatedArticles = [$allArticles[0], $allArticles[1]];
        $allArticles = array_slice($allArticles, 2);

        return $this->twig->render('Home/index.html.twig', [
                'mainArticle' => $mainArticle,
                'allArticles' => $allArticles,
                'relatedArticles' => $relatedArticles,
                'page' => 'home',
                ]);
    }
}
