<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\ArticleManager;
use App\Model\AuthorManager;
use App\Model\CategoryManager;

class AdminArticlesController extends AbstractController
{
    public function index(): string
    {
        $articleManager = new ArticleManager();

        if (isset($_GET['status'])) {
            $list = $_GET['status'];
            if ($list === 'archived') {
                $articles = $articleManager->selectByConditions('status', '3');
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

    public function add(): string
    {
        $author = new AuthorManager();
        $authors = $author->getAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->getAllCategory();

        return $this->twig->render('Admin/Article/add.html.twig', [
            'authors' => $authors,
            'categories' => $categories
        ]);
    }
}
