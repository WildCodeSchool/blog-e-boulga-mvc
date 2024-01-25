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
        $articleManager = New ArticleManager();
        $mainArticle = $articleManager->getMainArticle();
        return $this->twig->render('Home/index.html.twig', ['mainArticle' => $mainArticle, ] );
    }
}
