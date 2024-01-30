<?php

namespace App\Controller;

use App\Controller\AbstractController;

class AdminLoginController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Admin/Login/index.html.twig');
    }
}
