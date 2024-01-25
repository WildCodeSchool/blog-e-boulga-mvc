<?php

namespace App\Controller;

use App\Model\ArticleManager;

class ArticleController extends AbstractController
{
    /**
     * Display article informations specified by $id.
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
