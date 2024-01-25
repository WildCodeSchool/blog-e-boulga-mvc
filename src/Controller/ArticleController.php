<?php

namespace App\Controller;

use App\Model\ArticleManager;

class ArticleController extends AbstractController
{
    /**
     * Display home page
     */
    public function show(int $id): string
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticle($id);

        return $this->twig->render('Article/article.html.twig', [
            'article' => $article,
        ]);
    }
}
