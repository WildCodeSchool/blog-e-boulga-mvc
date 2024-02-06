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
                array_splice($allArticles, $key, 1);
            }
            if ($article->getCategoryId() === $mainArticle->getCategoryId()) {
                $relatedArticles[] = $article;
            }
        }

        foreach ($relatedArticles as $key => $article) {
            if ($article->getId() === $mainArticle->getId()) {
                array_splice($relatedArticles, $key, 1);
            }
        }

        if (count($relatedArticles) <= 0) {
            $relatedArticles = array_slice($allArticles, 0, 2);
        } elseif (count($relatedArticles) <= 1) {
            $relatedArticles[] = $allArticles[0];
            $allArticles = array_slice($allArticles, 1);
        } elseif (count($relatedArticles) <= 2) {
            $relatedArticles[] = $allArticles[0];
            $relatedArticles[] = $allArticles[1];
        }

        return $this->twig->render('Home/index.html.twig', [
                'mainArticle' => $mainArticle,
                'allArticles' => $allArticles,
                'relatedArticles' => $relatedArticles,
                ]);
    }
}
