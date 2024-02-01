<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\AuthorManager;

class ArticleController extends AbstractController
{
    public function index(): string
    {
        if (!$this->user) {
            header('Location: /admin/login');
            exit();
        }

        $articleManager = new ArticleManager();

        if (isset($_GET['status'])) {
            $list = $_GET['status'];
            if ($list === 'archived') {
                $articles = $articleManager->selectByConditions('status', '3');
            } elseif ($list === 'published') {
                $articles = $articleManager->selectByConditions('status', '2');
            } elseif ($list === 'draft') {
                $articles = $articleManager->selectByConditions('status', '1');
            } else {
                $articles = ['error' => 'Aucun article ne correspond à votre recherche'];
            }
        } else {
            $articles = $articleManager->selectAll();
        }


        return $this->twig->render('Admin/Article/index.html.twig', [
            'articles' => $articles
        ]);
    }
    /**
     * Display article informations specified by $id.
     */
    public function show(int $id): string
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticle($id);
        $authorId = $article->getAuthorId();

        $authorManager = new AuthorManager();
        $author = $authorManager->getById($authorId);

        return $this->twig->render('Article/article.html.twig', [
            'article' => $article,
            'author' => $author,
            'authorId' => $authorId,
        ]);
    }
}
