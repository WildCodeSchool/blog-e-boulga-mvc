<?php

namespace App\Controller;

use App\Model\CategoryManager;

class CategoriesController extends AbstractController
{
    public function index(): string | null
    {
        if (!$this->user) {
            header('Location: /admin/login');
            exit();
        }

        $category = new CategoryManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryName = trim($_POST['categoryName']);
            if (empty($categoryName)) {
                header('Location: /admin/categories?error=2');
                exit();
            }
            $category->create($categoryName);
            header('Location: /admin/categories');
            exit();
        }

        $categories = $category->selectAll();

        if (isset($_GET['error'])) {
            $error = match ($_GET['error']) {
                '1' => 'Vous ne pouvez pas supprimer une catégorie déjà attribuée à un article',
                '2' => 'Le nom de la catégorie ne peut pas être vide',
                default => '',
            };
        }

        return $this->twig->render('Admin/Categories/index.html.twig', [
            'categories' => $categories,
            'page' => 'categories',
            'error' => $error ?? null,
        ]);
    }

    public function delete(): void
    {
        if (!$this->user) {
            header('Location: /admin/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['categoryId']);
            $category = new CategoryManager();
            try {
                $category->delete((int) $id);
                header('Location: /admin/categories');
                exit();
            } catch (\PDOException $e) {
                echo $e->getMessage();
                header('Location: /admin/categories?error=1');
                exit();
            }
        }
    }
}
