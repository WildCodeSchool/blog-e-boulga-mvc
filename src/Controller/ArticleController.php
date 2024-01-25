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
        $authorId = $article->getAuthorId();

        $authorManager = new AuthorManager();
        $author = $authorManager->getAuthor($authorId);

        return $this->twig->render('Article/article.html.twig', [
            'article' => $article,
            'author' => $author,
        ]);
    }


}
