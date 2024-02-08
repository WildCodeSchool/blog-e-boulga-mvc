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
        $relatedArticles = [];

        foreach ($allArticles as $key => $article) {
            if ($article->getId() === $mainArticle->getId()) {
                unset($allArticles[$key]);
            } elseif ($article->getCategoryId() === $mainArticle->getCategoryId()) {
                if (count($relatedArticles) < 2) {
                    $relatedArticles[] = $article;
                    unset($allArticles[$key]);
                }
            }
        }

        if (count($relatedArticles) < 1) {
            $relatedArticles = [$allArticles[0], $allArticles[1]];
            unset($allArticles[0], $allArticles[1]);
        } elseif (count($relatedArticles) < 2) {
            $relatedArticles[] = $allArticles[0];
            unset($allArticles[0]);
        }

        return $this->twig->render('Home/index.html.twig', [
                'mainArticle' => $mainArticle,
                'allArticles' => $allArticles,
                'relatedArticles' => $relatedArticles,
                'page' => 'home',
                ]);
    }
}
