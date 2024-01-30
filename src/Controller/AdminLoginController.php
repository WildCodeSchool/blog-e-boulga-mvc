<?php

namespace App\Controller;

use App\Controller\AbstractController;

class AdminLoginController extends AbstractController
{
    public function index(): void
    {
        $this->twig->render('admin/index.html.twig');
    }
}
