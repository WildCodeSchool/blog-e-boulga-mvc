<?php

namespace App\Controller;

use App\Model\AdminUserManager;

class AdminUserController extends AbstractController
{
    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
//      @todo make some controls on email and password fields and if errors, send them to the view
            $userManager = new AdminUserManager();
            $user = $userManager->selectByLogin($credentials['login']);
            if ($user && password_verify($credentials['password'], $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                header('Location: /admin/articles');
                exit();
            } else {
                $error = 'Identifiants incorrects';
            }
        }

        if (isset($_SESSION['user_id'])) {
            header('Location: /admin/articles');
            exit();
        }

        return $this->twig->render('Admin/Login/index.html.twig', [
            'error' => $error ?? null,
            'login' => $credentials['login'] ?? null
        ]);
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        header('Location: /');
        exit();
    }
}
