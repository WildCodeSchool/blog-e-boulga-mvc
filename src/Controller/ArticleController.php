<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\ItemManager;

class ArticleController extends AbstractController
{
    /**
     * Display home page
     */
    public function show(int $id): string
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->selectOneById($id);

        // use html_entities_decode()

        return $this->twig->render('Article/article.html.twig', [
            'article' => $article,
            'classname' => ItemManager::CLASSNAME,
        ]);
    }
}
